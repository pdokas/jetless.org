var express = require('express'),
app = express.createServer();

app.configure(function config_global() {
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

app.configure('development', function config_dev() {
	app.use(express.logger({ format: ':method :url :response-time' }));
	app.use(express.errorHandler({ dumpExceptions: true, showStack: true }));
	// db = mongoose.connect('mongodb://localhost/jetless-dev');
});

app.configure('production', function config_prod() {
	app.use(express.logger());
	app.use(express.errorHandler());
	// db = mongoose.connect('mongodb://localhost/jetless-prod');
});

app.get('/', function handle_root(req, res) {
	res.send('Hello World');
});

/* = ADMIN ================================================================= */

app.get('/admin', function handle_admin_root(req, res) {
	if (check_auth(req, res)) {
		res.send('You made it!');
	}
});

/* = AUTH ================================================================== */

function check_auth(req, res) {
	var authorized = req.session.poobah;
	
	if (!authorized) {
		req.session.auth_redirect = req.originalUrl;
		res.redirect('/login');
	}
	
	return authorized;
}

app.get('/login', function handle_login(req, res) {
	res.render('login', {
		locals: {
			auth_redirect: req.session.auth_redirect
		}
	});
	
	req.session.auth_redirect = '';
});

app.post('/login/authenticate', function handle_authentication(req, res) {
	if (req.body.name === 'me' && req.body.pass === 'foo') {
		req.session.poobah = true;
		req.session.touch();
		
		res.redirect(req.body.auth_redirect);
	}
	else {
		// Add in something to indicate login failed
		res.redirect('/login');
	}
});

app.get('/logout', function handle_logout(req, res) {
	if (req.session) {
		req.session.destroy();
	}

	res.redirect('/');
});

if (!module.parent) {
	app.listen(3000);
	console.log("Express server listening on port %d, environment: %s", app.address().port, app.settings.env);
}