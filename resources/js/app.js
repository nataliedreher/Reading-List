require('./bootstrap');

// Function for handling the google books API call.
function displayBookInfo() {

    // Emptying the #book-list div and creating a var containing the search info for the
    // subsequent API search actions.
    $('#book-list').empty();
    var bookInput = $('#book-input').val().trim();

    // This reads the user inputs to either run the call or tell the user to finish inputting.
    if (bookInput && $('#book-radio input:radio:checked').val()) {

        var queryType;

        // Reading the query type selected by the user and setting queryType accordingly.
        if ($('#book-radio input:radio:checked').val() === 'option1') {
            queryType = 'inauthor:';
        } else {
            queryType = 'intitle:';
        };

        // Replacing spaces in the search just in case the google books api decides to be fussy.
        // This is followed by the construction of the queryURL and the ajax call.
        bookInput = bookInput.replace(' ', '+');
        var queryURL = 'https://www.googleapis.com/books/v1/volumes?q=' + queryType + bookInput;

        $.ajax({
            url: queryURL,
            method: 'GET'
        }).then(function (response) {

            var data = response.items;

            for (let i = 0; i < data.length; i++) {

                // Variables containing book details created from the ajax response.
                var author = data[i].volumeInfo.authors;
                var title = data[i].volumeInfo.title;
                var subtitle = data[i].volumeInfo.subtitle;
                var description = data[i].volumeInfo.description;

                // Variables containing jQuery to be appended to the page.
                var jumbotron = $('<div class="jumbotron" id="book' + i + '">');
                var pAuthor = $('<p>').text('Author: ' + author);
                var pTitle = $('<p>').text('Title: ' + title);

                // Below is where the appending happens, the ifs are for fields that may not be
                // included in the ajax responce. If they aren't included the error kills the
                // loop and it stops appending. #baduserexperience
                jumbotron.append(pAuthor);
                jumbotron.append(pTitle);

                if (subtitle) {
                    var pSubtitle = $('<p>').text('Subtitle: ' + subtitle);
                    jumbotron.append(pSubtitle);
                };

                if (description) {
                    var pDesc = $('<p>').text('Description: ' + description);
                    jumbotron.append(pDesc);
                };

                jumbotron.append('<button class="btn btn-primary book-add" type="button" data-id="' + i + '">Add to Reading List</button>')
                $('#book-list').append(jumbotron);
            }
        }).fail(function (err) {
            // Basic error handling.
            $('#book-list').append('<div class="jumbotron" id="book"><h4>No results</h4></div>');
        });
    } else {
        // Telling the user what info still needs to be inputted.
        if (bookInput) {
            $('#book-list').append('<div class="jumbotron" id="book"><h4>Enter Author or Title</h4></div>');
        } else {
            $('#book-list').append('<div class="jumbotron" id="book"><h4>Select Author or Title</h4></div>');
        };
    };
};

// The onclick event handler for searching books/authors via the google books api.
$(document).on('click', '#search-btn', displayBookInfo);

// The onclick event handler for adding books via front and back end API calls/routing.
$(document).on('click', '.book-add', function () {
    alert('hi')
});
