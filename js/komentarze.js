document.addEventListener('DOMContentLoaded', (event) => {
    fetchComments();
});

function addComment() {
    const nameInput = document.getElementById('nameInput');
    const commentInput = document.getElementById('commentInput');
    const nameText = nameInput.value;
    const commentText = commentInput.value;

    if (nameText.trim() !== '' && commentText.trim() !== '') {
        const formData = new FormData();
        formData.append('name', nameText);
        formData.append('comment', commentText);

        fetch('save_comment.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                fetchComments();
                nameInput.value = '';
                commentInput.value = '';
            } else {
                alert('Błąd podczas dodawania komentarza.');
            }
        });
    } else {
        alert('Proszę wpisać swoje imię i nazwisko oraz komentarz przed dodaniem.');
    }
}

function fetchComments() {
    fetch('get_comments.php')
        .then(response => response.json())
        .then(comments => {
            const commentContainer = document.getElementById('commentsContainer');
            commentContainer.innerHTML = '';
            comments.forEach(comment => {
                const newComment = document.createElement('div');
                newComment.classList.add('comment');

                const author = document.createElement('div');
                author.classList.add('comment-author');
                author.textContent = comment.name;

                const text = document.createElement('div');
                text.textContent = comment.comment;

                newComment.appendChild(author);
                newComment.appendChild(text);

                commentContainer.appendChild(newComment);
            });
        });
}
