$(document).ready(function() {
	let body = document.getElementById("body");
	let toggle_theme = document.getElementById("toggleTheme");
	toggle_theme.addEventListener("change", function() {
		body.classList.toggle('dark-theme');
	});
});