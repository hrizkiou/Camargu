function getDocumentHeight() {
    const body = document.body;
    const html = document.documentElement;

    return Math.max(
        body.scrollHeight,
        body.offsetHeight,
        html.clientHeight,
        html.scrollHeight,
        html.offsetHeight
    );
}

function getScrollTop() {
    return window.pageYOffset !== undefined
        ? window.pageYOffset
        : (document.documentElement || document.body.parentNode || document.body)
            .scrollTop;
}


var displayedPosts = 5;
function loadMore() {

    // displayedPosts = document.getElementById("post_count").value;
    var feed = document.getElementById('feed');


    displayedPosts = displayedPosts + 5;

    const request = new XMLHttpRequest();
    var data = new FormData();
    data.append('offset', displayedPosts);
    request.open('POST', 'nbrpost.php');

    request.onload = function () {

       feed.insertAdjacentHTML('beforeend', request.responseText);

       //  // document.documentElement.innerHTML = this.responseText;
       //  console.log("javas" , request.responseText);

    }
    request.send(data);

}

window.addEventListener("scroll", scrolling);

function scrolling() {
    if (getScrollTop() < getDocumentHeight() - window.innerHeight) return;
    loadMore();
}