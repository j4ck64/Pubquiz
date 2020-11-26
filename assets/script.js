function deleteRow(id,slug)
{
	var id = id;
	var slug = slug;
	//qualifyURL taken from: https://stackoverflow.com/a/6728577
	//checks the baseurl + pathOrURL is valid.
	var qualifyURL = function (pathOrURL) {
		if (!new RegExp("^(http(s)?[:]//)", "i").test(pathOrURL)) {
			return $(document.body).data("base") + pathOrURL;
		}

		return pathOrURL;
	};
	
	$.ajax({
		type: "GET",
		url: qualifyURL("questions/browse"),
		data: { id: id, slug: slug },
		cache: false,
		async: true,
		success: function (result) {
			console.log("success");
			//refresh page
			  window.location.href = window.location.pathname;
		},
		// logs the url it tried to redirect to and error cause
		error: function (e) {
			var pathname = window.location.pathname;
			console.log("failure: " + pathname + " " + e);
		},
		
	});
}

function saveAnswer(id, anwser, slug) {
	var id = id;
	var anwser = anwser;
	var slug = slug;

	//qualifyURL taken from: https://stackoverflow.com/a/6728577
	//checks the baseurl + pathOrURL is valid.
	var qualifyURL = function (pathOrURL) {
		if (!new RegExp("^(http(s)?[:]//)", "i").test(pathOrURL)) {
			return $(document.body).data("base") + pathOrURL;
		}

		return pathOrURL;
	};

	$.ajax({
		type: "POST",
		url: qualifyURL("users/save_user_answer"),
		data: { id: id, anwser: anwser, slug: slug },
		cache: false,
		async: true,
		success: function (result) {
			console.log("success");
			//redirect to the next page based on the slug
			window.location.href = qualifyURL("questions/" + slug);
			
		},
		// logs the url it tried to redirect to and error cause
		error: function (e) {
			var pathname = window.location.pathname;
			console.log("failure: " + pathname + " " + e);
		},
	});
}

