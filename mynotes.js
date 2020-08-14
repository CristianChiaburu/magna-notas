$(function () {
  // define variables
  var activeNote = 0;
  var editMode = false;
  // load notes on page: Ajax call to loadnotes.php
  $.ajax({
    url: 'loadnotes.php',
    success: function (data) {
      $('#notes').html(data);
      clickOnNote(); clickOnDelete();
    },
  });
  // add a new note: Ajax call to createnote.php
  $('#addNote').click(function () {
    $.ajax({
      url: 'createnote.php',
      success: function (data) {
        if (data == 'error') {
          $('#alertContent').text(
            'There was an issue inserting the new note in the database.'
          );
          $('#alert').fadeIn();
        } else {
          // update activeNote to the id of the new note
          activeNote = data;
          $('textarea').val('');
          // show hide elements
          showHide(
            ['#notePad', '#allNotes'],
            ['#notes', '#addNote', '#edit', '#done']
          );
          $('textarea').focus();
        }
      },
      error: function () {
        $('#alertContent').text(
          'There was an an error with the Ajax call. Please try again later.'
        );
        $('#alert').fadeIn();
      },
    });
  });
  // typing a note: Ajax call to updatenote.php
  $('textarea').keyup(function () {
    $.ajax({
      url: 'updatenote.php',
      type: 'POST',
      // we need to send the current note content with its id
      data: { note: $(this).val(), id: activeNote },
      success: function (data) {
        if (data == 'error') {
          $('#alertContent').text(
            'There was an issue updating the note. Please try again later.'
          );
          $('#alert').fadeIn();
        }
      },
    });
  });
  // click on all notes button
  $('#allNotes').click(function () {
    $.ajax({
      url: 'loadnotes.php',
      success: function (data) {
        $('#notes').html(data);
        showHide(['#addNote', '#edit', '#notes'], ['#allNotes', '#notePad']);
        clickOnNote(); clickOnDelete();
      },
      error: function () {
        $('#alertContent').text(
          'There was an error with the Ajax call. Please try again.'
        );
        $('$alert').fadeIn();
      },
    });
  });
  // click on done button (also loading notes again)
  $('#done').click(function(){
    editMode = false;
    showHide(['#edit'],['#done', '.delete']);
  })
  // click on edit: go to edit mode
  $('#edit').click(function () {
    editMode = true;
    // $('.noteheader').addClass('col-7 col-sm-9');
    showHide(['#done', '.delete'], [this]);
  });

  // functions
  function clickOnNote() {
    $('.noteheader').click(function () {
      if (!editMode) {
        // update active note variable to id of note
        activeNote = $(this).attr('id');
        // fill text area
        $('textarea').val($(this).find('.text').text());
        showHide(
          ['#notePad', '#allNotes'],
          ['#notes', '#addNote', '#edit', '#done']
        );
        $('textarea').focus();
      }
    });
  }

  function clickOnDelete() {
    $('.delete').click(function () {
      var deleteButton = $(this);
      $.ajax({
        url: 'deletenote.php',
        type: 'POST',
        data: { id: deleteButton.parent().attr('id') },
        success: function (data) {
          if (data == 'error') {
            $('#alertContent').text(
              'There was an issue deleting the note from the database.'
            );
          } else {
            deleteButton.parent().remove();
          }
        },
      });
    });
  }

  function showHide(array1, array2) {
    for (i = 0; i < array1.length; i++) {
      $(array1[i]).show();
    }
    for (i = 0; i < array2.length; i++) {
      $(array2[i]).hide();
    }
  }
});
