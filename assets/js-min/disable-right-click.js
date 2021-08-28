function disableClick(e) {
  var message = 'Изображение будет доступно для скачивания после оплаты.';
  if (document.all) {
    if (((event.button == 2) || (event.button == 3)) && ((event.srcElement.tagName == "IMG") || (event.srcElement.getAttribute("type").toUpperCase() == "IMAGE"))) {
      if (event.srcElement.oncontextmenu) {
        event.srcElement.oncontextmenu = function(event) {
          if (event.preventDefault) {
            event.preventDefault();
          };
          if (event.stopPropagation) {
            event.stopPropagation();
          };
          if (event.returnValue) {
            event.returnValue = false;
          };
        };
      } else {

        if (event.srcElement.addEventListener) {
          event.srcElement.addEventListener("contextmenu", function(event) {
              if (event.preventDefault) {
                event.preventDefault();
              };
              if (event.stopPropagation) {
                event.stopPropagation();
              };
              if (event.returnValue) {
                event.returnValue = false;
              };
            }

          );
        } else if (event.srcElement.attachEvent) {
          event.srcElement.attachEvent("contextmenu", function(event) {
              if (event.preventDefault) {
                event.preventDefault();
              };
              if (event.stopPropagation) {
                event.stopPropagation();
              };
              if (event.returnValue) {
                event.returnValue = false;
              };
            }

          );
        };

      };

      alert(message);
      return false;
    };
  } else if (document.layers)

  {
    if ((e.which == 2) || (e.which == 3)) {

      if (e.target.oncontextmenu) {
        e.target.oncontextmenu = function(e) {
          if (e.preventDefault) {
            e.preventDefault();
          };
          if (e.stopPropagation) {
            e.stopPropagation();
          };
          if (e.returnValue) {
            e.returnValue = false;
          };
        };
      } else {

        if (e.target.addEventListener) {
          e.target.addEventListener("contextmenu", function(e) {
              if (e.preventDefault) {
                e.preventDefault();
              };
              if (e.stopPropagation) {
                e.stopPropagation();
              };
              if (e.returnValue) {
                e.returnValue = false;
              };
            }

          );
        };


      };


      alert(message);
      return false;
    };
  } else if (document.getElementById)

  {
    if (((e.which == 2) || (e.which == 3)) && ((e.target.tagName == "IMG") || (e.target.getAttribute("type") && e.target.getAttribute("type").toUpperCase() == "IMAGE"))) {

      if (e.target.oncontextmenu) {
        e.target.oncontextmenu = function(e) {
          if (e.preventDefault) {
            e.preventDefault();
          };
          if (e.stopPropagation) {
            e.stopPropagation();
          };
          if (e.returnValue) {
            e.returnValue = false;
          };
        };
      } else {

        if (e.target.addEventListener) {
          e.target.addEventListener("contextmenu", function(e) {
              if (e.preventDefault) {
                e.preventDefault();
              };
              if (e.stopPropagation) {
                e.stopPropagation();
              };
              if (e.returnValue) {
                e.returnValue = false;
              };
            }

          );
        };


      };


      alert(message);
      return false;

    };
  };

};

function associateImages() {
  for (i = 0; i < document.images.length; i++) {
    document.images[i].onmousedown = disableClick;
  };

};

if (document.all) {
  if (document.onmouseup) {
    document.onmouseup = disableClick;
  } else {
    window.onmouseup = disableClick;
  };

} else if (document.getElementById) {
  if (document.onmousedown) {
    document.onmousedown = disableClick;
  } else {
    window.onmousedown = disableClick;
  };

} else if (document.layers) {
  associateImages();
};

var myVideo = document.getElementById("main-video");
if (myVideo.addEventListener) {
    myVideo.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    }, false);
} else {
    myVideo.attachEvent('oncontextmenu', function() {
        window.event.returnValue = false;
    });
}