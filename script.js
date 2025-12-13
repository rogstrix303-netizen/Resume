$(function(){

  // ON SUBMIT (SERVER + AUTO PREVIEW)
  $('#regForm').on('submit', function(e){
    e.preventDefault();

    var $btn = $('#submitBtn')
                .prop('disabled', true)
                .text('Submitting...');

    var form = $(this);

    $.ajax({
      url: form.attr('action'),
      method: form.attr('method'),
      data: form.serialize(),
      dataType: 'html',

      // If PHP works → show server response
      success: function(response){
        $('#result').html(
          '<div class="success-msg">✔ Submitted successfully</div>' +
          response
        );
      },

      // If PHP fails → show client preview
      error: function(){
        $('#result').html(
          '<div class="success-msg">✔ Submitted (client-side preview)</div>' +
          buildPreviewHtml(getFormData())
        );
      },

      complete: function(){
        $btn.prop('disabled', false).text('Submit (server)');
      }
    });
  });

  // Get form data into object
  function getFormData(){
    return {
      fullname: $('[name=fullname]').val(),
      email: $('[name=email]').val(),
      phone: $('[name=phone]').val(),
      dob: $('[name=dob]').val(),
      address: $('[name=address]').val(),
      course: $('[name=course]').val(),
      comments: $('[name=comments]').val()
    };
  }

  // Build preview HTML
  function buildPreviewHtml(d){
    function r(label, val){
      return `
        <div class="preview-row">
          <strong>${label}</strong>
          <div class="small">${val ? escapeHtml(val) : '<em>—</em>'}</div>
        </div>
      `;
    }

    return `
      <div class="preview-card">
        <h3>Application Preview</h3>
        ${r('Full name', d.fullname)}
        ${r('Email', d.email)}
        ${r('Phone', d.phone)}
        ${r('Date of birth', d.dob)}
        ${r('Address', d.address)}
        ${r('Course', d.course)}
        ${r('Comments', d.comments)}
      </div>
    `;
  }

  // Escape HTML
  function escapeHtml(s){
    return $('<div>').text(s).html();
  }

});
