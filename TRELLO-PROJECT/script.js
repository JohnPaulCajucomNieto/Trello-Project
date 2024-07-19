function openReviewForm() {
    document.getElementById('reviewPopup').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}

function closeReviewForm() {
    document.getElementById('reviewPopup').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}

function addReview() {
    const reviewText = document.getElementById('reviewText').value;
    if (reviewText.trim() !== '') {
        const reviewContainer = document.querySelector('.list-review');
        const newReview = document.createElement('div');
        newReview.classList.add('box-review1');
        newReview.innerHTML = '<hr><p>' + reviewText + '</p>';
        reviewContainer.appendChild(newReview);
        closeReviewForm();
    } else {
        alert('Please enter a valid review.');
    }
}
