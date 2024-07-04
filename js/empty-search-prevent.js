document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.querySelector('.search-form');
    const searchInput = searchForm.querySelector('.search-field');
    searchForm.addEventListener('submit', function(event) {
        if (searchInput.value.trim() === '') {
            event.preventDefault();
        }
    });
});
