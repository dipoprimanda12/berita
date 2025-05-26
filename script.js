document.getElementById('searchInput').addEventListener('input', function () {
  const keyword = this.value.toLowerCase();
  const posts = document.querySelectorAll('.post');

  posts.forEach(post => {
    const title = post.querySelector('h3').textContent.toLowerCase();
    post.style.display = title.includes(keyword) ? 'block' : 'none';
  });
});
