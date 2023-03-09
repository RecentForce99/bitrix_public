   $('.feedback-form-ajax').submit(function (e) {
         e.preventDefault();

         var that = $(this),
             formData = new FormData(that.get(0));

         $.ajax({
             contentType: false,
             processData: false,
             type: 'POST',
             url: '/ajax/feedback/feedback.php',
             data: formData,
             dataType: 'html',

             success: function (response) {
                 
             },

         });
         return false;

     });


     $( document ).on('click', '.catalog-choice__item', function () {
   
         $.ajax({
             url: '/ajax/catalog/filterURL.php?PAGE_ID=0',
             type: "POST",
             dataType: "html",
             success: function (response) {
                
             }
         })

     })
