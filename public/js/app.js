class Errors {

	constructor() {
		this.errors = {};
	}

	get(field) {
		if (this.errors[field]) {
			return this.errors[field][0];
		}
	}

	set(errors) {
		this.errors = errors;
	}

	has(field) {
		return this.errors.hasOwnProperty(field);
	}

	any() {
		return Object.keys(this.errors).length > 0 ;
	}

	clear(field) {
		delete this.errors[field];
	}
}

class Blogger {
	constructor() {
		this.blogger = {};
	}

	record(results) {
			this.blogger = results;
	}

	getSlug() {
		if (this.any()) {
			return this.blogger;
		}
	}

	any() {
		return Object.keys(this.blogger).length > 0 ;
	}
}

class Wordpress {
	constructor() {
		this.wordpress = {};
	}

	record(results) {
			this.wordpress = results;
	}

	getSlug() {
		if (this.any()) {
			return this.wordpress;
		}
	}

	any() {
		return Object.keys(this.wordpress).length > 0 ;
	}
}

class Fixed {
	constructor() {
		this.fixed = {};
	}

	record(results) {
			this.fixed = results;
	}

	getSlug(field) {
		if (this.any()) {
			return this.fixed[field];
		}
	}

	any() {
		return Object.keys(this.fixed).length > 0 ;
	}
}

new Vue({
	el: '#root',

	data: {
		blogger_id : '',
		wordpress_url : '',
		errors : new Errors(),
		blogger : new Blogger(),
		wordpress : new Wordpress(),
		fixed : new Fixed(),
		wordpress_token : '',
		wordpress_fix : '', 
		show_loading : false
	},

	methods: {
		onSubmit() {
			this.show_loading = true;
			axios.post('/slugchecker/blogger' , this.$data)
				 .then(this.successBlogger)
				 .catch(error => this.errors.set(error.response.data));
		},

		successBlogger(response) {
			this.show_loading = false;
			this.blogger.record(response.data);

			this.show_loading = true;
			axios.post('/slugchecker/wordpress/broken' , this.$data)
				 .then(this.successWordpress)
				 .catch(error => console.log(error));
		},

		successWordpress(response) {
			this.show_loading = false;
			this.wordpress.record(response.data);

			if (this.wordpress_token) {
				this.show_loading = true;
				axios.post('/slugchecker/fix' , this.$data)
				 .then(this.successFix)
				 .catch(error => console.log(error));
			}
		},
		
		successFix(response) {
			this.show_loading = false;
			this.fixed.record(response.data);
		}
	}

});