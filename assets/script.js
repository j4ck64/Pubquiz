function saveAnswer(id, anwser, slug) {
	var id = id;
	var anwser = anwser;
	var slug = slug;

	//qualifyURL taken from: https://stackoverflow.com/a/6728577
	var qualifyURL = function (pathOrURL) {
		if (!new RegExp("^(http(s)?[:]//)", "i").test(pathOrURL)) {
			return $(document.body).data("base") + pathOrURL;
		}

		return pathOrURL;
	};

	$.ajax({
		type: "POST",
		// url: "../users/save",
		url: qualifyURL("users/save"),
		data: { id: id, anwser: anwser, slug: slug },
		cache: false,
		async: true,
		success: function (result) {
			console.log("success");
			// location.href="<?php echo site_url('/questions/' . $slug); ?>"
			// window.location.href = "questions/"+slug;
			if (slug == "result") {
				window.location.href = qualifyURL("questions/" + slug);
			} else {
				window.location.href = "questions/" + slug;
			}
		},
		error: function (e) {
			var pathname = window.location.pathname;

			console.log("failure: " + pathname + " " + e);
		},
	});
}
