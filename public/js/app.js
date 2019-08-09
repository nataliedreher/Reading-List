(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/app"],{

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js"); // Function for handling the google books API call.


function displayBookInfo() {
  // Emptying the #book-list div and creating a var containing the search info for the
  // subsequent API search actions.
  $('#book-list').empty();
  var bookInput = $('#book-input').val().trim(); // This reads the user inputs to either run the call or tell the user to finish inputting.

  if (bookInput && $('#book-radio input:radio:checked').val()) {
    var queryType; // Reading the query type selected by the user and setting queryType accordingly.

    if ($('#book-radio input:radio:checked').val() === 'option1') {
      queryType = 'inauthor:';
    } else {
      queryType = 'intitle:';
    }

    ; // Replacing spaces in the search just in case the google books api decides to be fussy.
    // This is followed by the construction of the queryURL and the ajax call.

    bookInput = bookInput.replace(' ', '+');
    var queryURL = 'https://www.googleapis.com/books/v1/volumes?q=' + queryType + bookInput;
    $.ajax({
      url: queryURL,
      method: 'GET'
    }).then(function (response) {
      var data = response.items;

      for (var i = 0; i < data.length; i++) {
        // Variables containing book details created from the ajax response.
        var author = data[i].volumeInfo.authors;
        var title = data[i].volumeInfo.title;
        var subtitle = data[i].volumeInfo.subtitle;
        var description = data[i].volumeInfo.description; // Variables containing jQuery to be appended to the page.

        var jumbotron = '<div class="jumbotron" id="book' + i + '"><form method="POST" action="/books">';
        var pAuthor = '<p><strong>Author:</strong> ' + author;
        var pTitle = '<p><strong>Title:</strong> ' + title; // Below is where the appending happens, the ifs are for fields that may not be
        // included in the ajax responce. If they aren't included the error kills the
        // loop and it stops appending. #baduserexperience

        jumbotron += pAuthor;
        jumbotron += '<input type="hidden" name="author" value="' + author + '">';
        jumbotron += pTitle;
        jumbotron += '<input type="hidden" name="title" value="' + title + '">';

        if (subtitle) {
          var pSubtitle = '<p><strong>Subtitle:</strong> ' + subtitle;
          jumbotron += pSubtitle;
          jumbotron += '<input type="hidden" name="subtitle" value="' + subtitle + '">';
        }

        ;

        if (description) {
          var pDesc = '<p><strong>Description:</strong> ' + description;
          jumbotron += pDesc;
          jumbotron += '<input type="hidden" name="description" value="' + description + '">';
        }

        ;
        jumbotron += '<br><button class="btn btn-primary book-add" type="submit" data-id="' + i + '">Add to Reading List</button>';
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
    }

    ;
  }

  ;
}

; // The onclick event handler for searching books/authors via the google books api.

$(document).on('click', '#search-btn', displayBookInfo);
$(document).on('keypress', '#book-input', function (e) {
  if (e.keyCode === 13) {
    // If Enter key pressed
    displayBookInfo();
  }
});

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

window._ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  window.Popper = __webpack_require__(/*! popper.js */ "./node_modules/popper.js/dist/esm/popper.js")["default"];
  window.$ = window.jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

  __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js");
} catch (e) {}
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */


window.axios = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

var token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from 'laravel-echo'
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\Users\Natalie\Desktop\code\Solo-Projects\Reading-List\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\Users\Natalie\Desktop\code\Solo-Projects\Reading-List\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

},[[0,"/js/manifest","/js/vendor"]]]);