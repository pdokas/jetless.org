var express = require('express'),
app = express.createServer();

app.configure(function() {
	app.set('view engine', 'hbs');
	app.set('views', __dirname + '/views');

	// app.use(express.responseTime()); // should be #1
	app.use(express.conditionalGet());
	app.use(express.cookieDecoder()); // needs to precede session()
	app.use(express.session());
	app.use(express.bodyDecoder());
	app.use(express.methodOverride());
	app.use(app.router);
	app.use(express.staticProvider(__dirname + '/assets'));
});

app.configure('development', function() {
	app.use(express.logger({ format: ':method :url :response-time' }));
	app.use(express.errorHandler({ dumpExceptions: true, showStack: true }));
	// db = mongoose.connect('mongodb://localhost/nodepad-development');
});

app.configure('production', function() {
	app.use(express.logger());
	app.use(express.errorHandler());
	// db = mongoose.connect('mongodb://localhost/nodepad-production');
});

app.get('/', function(req, res) {
	res.send('Hello World');
});

app.get('/login', function(req, res) {
	res.render('login', {
		locals: {
			auth_redirect: req.session.auth_redirect
		}
	});
	
	req.session.auth_redirect = '';
});

app.get('/admin', function(req, res) {
	if (!req.session.poobah) {
		req.session.auth_redirect = '/admin';
		res.redirect('/login');
	}

	res.send('You made it!');
});

app.post('/login/authenticate', function(req, res) {
	if (req.body.name === 'me' && req.body.pass === 'foo') {
		req.session.poobah = true;
		req.session.touch();
		
		res.redirect(req.body.nextpage);
	}
	else {
		// Add in something to indicate login failed
		res.redirect('/login');
	}
});

app.get('/logout', function(req, res) {
	if (req.session) {
		req.session.destroy();
	}

	res.redirect('/');
});

if (!module.parent) {
	app.listen(3000);
	console.log("Express server listening on port %d, environment: %s", app.address().port, app.settings.env);
}