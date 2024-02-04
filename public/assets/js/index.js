const toggleModal = (id) => {
    const modal = document.querySelector(`[data-id="${id}"]`);
    modal.classList.toggle("active");
}