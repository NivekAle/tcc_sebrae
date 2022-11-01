function CardDropdown(id) {
	const card = document.querySelector(`#produto-${id}`);
	const dropdown = card.querySelector(".produto-card__dropdown");
	dropdown.classList.toggle("drop");
}