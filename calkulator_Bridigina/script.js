$(document).ready(function () {
	$('#b-1').on('click', myAJAX);
});

function myAJAX() {
	$.post(
		"test.php",
		{
			"a": $('#num1').val(),
			"b": $('#num2').val(),
			"c": $('#select').val(),
		},
		function (data) {
			document.querySelector('#out').textContent = data;
		}
	);
}

//button change color calculator

let calcBackground = document.querySelector('.calculator');

document.querySelector('#change-color').onclick = function () {
	calcBackground.classList.toggle('colorTwo');
}