class TwitterSearchWidget {
	constructor(params) {
		this.url = params?.url;
		this.query = params?.query;
		this.bearer_token = params?.bearer_token;
	}

	init() {
		let self = this;

		$.ajax({
			url: self.url,
			method: 'GET',
			dataType: 'json',
			async: true,
		    crossDomain: true,
			headers: {
				'Authorization': `Bearer ${self.bearer_token}`,
				'Content-Type': 'application/json',
				'withCredentials': false
			},
			success: function(s) {
				console.log(s)
			},
			error: function(e) {
				console.log(e)
			}
		});
	}
}