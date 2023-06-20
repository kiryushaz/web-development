function get_search_results() {
	let xhttp = new XMLHttpRequest();
	let results = document.getElementById("search_results");

	xhttp.onload = function() {
		
		if (search_field.value == '') {
			results.style.display = 'none';
		} else {
			results.style.display = 'block';
			results.innerHTML = this.responseText;
		}
		
	}

	xhttp.open("GET", `utils/ajax.php?q=${search_field.value}`);
	xhttp.send();
}

const search_field = document.getElementById("ajax");
search_field.addEventListener("keydown", get_search_results);