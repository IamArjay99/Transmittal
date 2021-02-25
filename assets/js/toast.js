(function($) {
  showSuccessToast = function(text) {
    'use strict';
    resetToastPosition();
    $.toast({
      heading: 'Success',
      text: text,
      showHideTransition: 'slide',
      icon: 'success',
      position: {
        right: 3,
        top: 63
      },
      loaderBg: '#ffffff',
      hideAfter: 7000, 
    })
  };

  showRoleModuleSuccessToast = function(text,backColor) {
    'use strict';
    resetToastPosition();
    $.toast({
      heading: 'Success',
      text: text,
      showHideTransition: 'slide',
      icon: 'success',
      position: {
        right: 3,
        top: 63
      },
      bgColor: backColor,
      loaderBg: '#ffffff',
      hideAfter: 7000, 
    })
  };

  showRoleSuccessToast = function(text) {
    'use strict';
    resetToastPosition();
    $.toast({
      heading: 'Success',
      text: text,
      showHideTransition: 'slide',
      icon: 'success',
      position: {
        right: 3,
        top: 63
      },
      loaderBg: '#ffffff',
      hideAfter: 7000, 
    })
  };

  showPhotoToast = function() {
    'use strict';
    resetToastPosition();
    $.toast({
      heading: 'Success',
      text: "Photo successfully uploaded!",
      showHideTransition: 'slide',
      icon: 'success',
      position: {
        right: 3,
        top: 63
      },
      loaderBg: '#ffffff',
      hideAfter: 7000, 
    })
  };

    showUploadPhotoError = function() {
    'use strict';

    resetToastPosition();
    $.toast({
      heading: 'Danger',
      text: 'File not supported! Please select a JPEG or PNG File and try again.',
      showHideTransition: 'slide',
      icon: 'error',
      position: {
        right: 3,
        top: 63
      },
      loaderBg: '#ffffff',
      hideAfter: 7000 
    });
  }

  showUploadTimekeepingError = function(text) {
    'use strict';

    resetToastPosition();
    $.toast({
      heading: 'Error',
      text: text,
      showHideTransition: 'slide',
      icon: 'error',
      position: {
        right: 3,
        top: 63
      },
      loaderBg: '#ffffff',
      hideAfter: 7000 
    });
  }

    showdataSuccessToast = function() {
    'use strict';
    resetToastPosition();
    $.toast({
      heading: 'Success',
      text: 'Employee status successfully changed!',
      showHideTransition: 'slide',
      icon: 'success',
      position: {
        right: 3,
        top: 63
      },
      loaderBg: '#ffffff',
      hideAfter: 7000, 
    });
  };

  showErrorToast = function(text) {
    'use strict';
    resetToastPosition();
    $.toast({
      heading: 'Error',
      text: text,
      showHideTransition: 'slide',
      icon: 'error',
      position: {
        right: 3,
        top: 63
      },
      loaderBg: '#ffffff',
      hideAfter: 7000, 
    })
  };

  resetToastPosition = function() {
    $('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center'); // to remove previous position class
    $(".jq-toast-wrap").css({
      "top": "",
      "left": "",
      "bottom": "",
      "right": ""
    }); //to remove previous position style
  }

  showdataSuccess13thToast = function() {
    'use strict';
    resetToastPosition();
    $.toast({
      heading: 'Success',
      text: 'The 13th month has been successfully processed.',
      showHideTransition: 'slide',
      icon: 'success',
      position: {
        right: 3,
        top: 63
      },
      loaderBg: '#ffffff',
      hideAfter: 7000, 
    });
  };
  showdataSuccessbillingthToast = function() {
    'use strict';
    resetToastPosition();
    $.toast({
      heading: 'Success',
      text: 'The billing statement has been successfully processed.',
      showHideTransition: 'slide',
      icon: 'success',
      position: {
        right: 3,
        top: 63
      },
      loaderBg: '#ffffff',
      hideAfter: 7000, 
    });
  };
})(jQuery);