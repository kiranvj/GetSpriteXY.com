/**
 * Filename: get-sprite-xy.js
 * Version : 1.0.35
 *
 * http://GetSpriteXY.com/
 *
 * @Author : Kiran Paul V.J.
 *
 */
var SpriteXY = function() {

    // All variables goes here
    this.$loadedSpriteImage       = $("#loaded-sprite-image"),
    this.$spriteUploadControl     = $("#sprite-upload"),
    this.$colorSelectors          = $(".background-colors"),
    this.$transparentBGSelector   = $("#transparent-bg"),
    this.COLOR_SELECTED_CLASS     = "selected",
    this.$colorChangeElements     = "",
    this.loadSpriteImageSrc       = "",
    this.x                        = "",
    this.y                        = "",
    this.x2                       = "",
    this.y2                       = "",
    this.width                    = "",
    this.height                   = "",
    this.$selectionX              = $("#selection-x"),
    this.$selectionY              = $("#selection-y"),
    this.$selectionHeight         = $("#selection-height"),
    this.$selectionWidth          = $("#selection-width"),
    this.isReleasedFlag           = true,
    this.$userBackgroundContainer = $("#user-backgrounds-container"),
    __spriteXY                    = this, // internal object reference
    this.$infoPanel               = $("#info-panel"),
    this.$infoData                = $(".info-data"),
    this.$styleOutput             = $("#style-output"), // style output textarea
    this.$spriteDiv               = $("#generated-sprite-div"), // generated sprite image
    this.EVENT_CLICK              = "click",
    this.EVENT_CHANGE             = "change",
    this.jCropHandler             = "";
    this.oFReader                 = window.FileReader ? new FileReader() : null, 
    this.rFilter                  = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;
    
    this.notifyMe = function(isSelectMouseUp) { 
    isSelectMouseUp = !! isSelectMouseUp;
        $.ajax({
            url: 'notify-ajax.php',  //server script to process data
            type: 'POST',
            dataType: "json",
            data: {"isSpriteCreated" : isSelectMouseUp},
            cache: false,
            success: function() {
                //console.log("Success");
            },
            error: function() {
                //console.log("Error");
            }
        });
    }
    
    this.updateInformation = function(c, isSelectMouseUp){
          isSelectMouseUp = !! isSelectMouseUp;
          
          __spriteXY.x      = Math.round(c.x);
          __spriteXY.y      = Math.round(c.y);
          __spriteXY.x2     = Math.round(c.x2);
          __spriteXY.y2     = Math.round(c.y2);
          __spriteXY.width  = Math.round(c.w);
          __spriteXY.height = Math.round(c.h);
          
          __spriteXY.$selectionX.html(__spriteXY.x);
          __spriteXY.$selectionY.html(__spriteXY.y);
          __spriteXY.$selectionWidth.html(__spriteXY.width);
          __spriteXY.$selectionHeight.html(__spriteXY.height);
          
          
          // Update generated sprite div
          __spriteXY.$spriteDiv.css({
                                    width:__spriteXY.width,
                                    height:__spriteXY.height,
                                    backgroundPosition: __spriteXY.x * -1 + "px " + __spriteXY.y * -1 + "px "  
                                    });
          
          //Update styles
          __spriteXY.$styleOutput.val("background-position: " + __spriteXY.x * -1 + "px " + __spriteXY.y * -1 + "px; "+ "\nwidth: " + __spriteXY.width + "px;\nheight: " + __spriteXY.height + "px;");
          
          if(isSelectMouseUp) {
              __spriteXY.notifyMe(isSelectMouseUp);
           }   
    };

    this.clearOnRelease = function () {
         __spriteXY.isReleasedFlag = true;
         __spriteXY.$infoData.html("");
         __spriteXY.$styleOutput.val("");
         __spriteXY.$spriteDiv.css({
                                    width:0,
                                    height:0,
                                    backgroundPosition:"0 0"  
                                    });
    };
    
    this.deleteUserBackground = function() {
            $(this).parent().remove();
    };
    
    this.updateSpriteImageSrc = function() {
            this.loadSpriteImageSrc = this.$loadedSpriteImage.attr("src");
            this.$spriteDiv.css("background-image", "url('" + this.loadSpriteImageSrc + "')");
    }
}

SpriteXY.prototype.init = function() {

    var $buttonMovePanelLeft   = $("#move-panel-left"),
        $buttonMovePanelRight  = $("#move-panel-right"),
        $buttonWhatWhy         = $("#what-why"),
        $helperWindow          = $("#helper-window"),
        $buttonHelperClose     = $("#close-helper"),
        _this                  = this;
    
    this.$loadedSpriteImage.Jcrop({
             onChange:   this.updateInformation,
             onSelect:   function(oDetails) {
                 _this.updateInformation(oDetails, true);
             },
             onRelease:  this.clearOnRelease
            },function() {
                 oSpriteXY.jCrop = this;
              });
    // Update image source
    this.updateSpriteImageSrc();
    
    if(this.oFReader)
    {
    // Event handlers
    this.$spriteUploadControl.bind(this.EVENT_CHANGE,function() {
                                                              
                                                              loadImageFile();
                                                              _this.notifyMe();
                                                              
                                                              });
    
    this.oFReader.onload = function (oFREvent) {	  
          var imageData = oFREvent.target.result;
          oSpriteXY.$loadedSpriteImage.attr("src", imageData);
          oSpriteXY.jCrop.setImage(imageData);
          oSpriteXY.updateSpriteImageSrc();
          
        };	
    }
    
    
    /* Change background color */
    this.$colorSelectors.click(function() {
                                        
        var $clickedElement       = $(this),
            selectedColor         = $clickedElement.css("background-color"),
            $colorChangeElements  = "";
    /*
     * Get the object of elements to be color changed.
     * This is not done at the begining because jCorp element 
     * will not be available during the code init.
     *
     */	
     $colorChangeElements = $(".jcrop-holder , #generated-sprite-div-wrapper");   
    
     $colorChangeElements.css({"background-color" : selectedColor,
                                        "background-image" : "none"
                                       });
        
        
        //
        _this.$colorSelectors.removeClass(_this.COLOR_SELECTED_CLASS);
        _this.$transparentBGSelector.removeClass(_this.COLOR_SELECTED_CLASS);
        
        $clickedElement.addClass(_this.COLOR_SELECTED_CLASS);
        
    });
    
    this.$transparentBGSelector.click(function() {
        
        var $clickedElement = $(this),
            $colorChangeElements = $(".jcrop-holder , #generated-sprite-div-wrapper");	
        //
        _this.$colorSelectors.removeClass(_this.COLOR_SELECTED_CLASS);
        
        $colorChangeElements.css("background-image", "url(\"images/transparent-bg.png\")");
        
        $clickedElement.addClass(_this.COLOR_SELECTED_CLASS);
        
    });
    /* End of change background color */

    /* Start : Info panel position change */    
    $buttonMovePanelLeft.click(function() {
        _this.$infoPanel.removeClass("is-right-aligned").addClass("is-left-aligned");
    });
    $buttonMovePanelRight.click(function() {
        _this.$infoPanel.removeClass("is-left-aligned").addClass("is-right-aligned");
    });
    /* End : Info panel position change */
    
    /* Start : Show - Hide helper */
    $buttonWhatWhy.click(function(event) {
        $helperWindow.show();
        return false;
    });
    $buttonHelperClose.click(function() {
        $helperWindow.hide();
    }); 
    /* End : Show - Hide helper */
    function loadImageFile() 
    {
      
      if(oSpriteXY.$spriteUploadControl.get(0).files.length === 0) { return; }
      
      var oFile = oSpriteXY.$spriteUploadControl.get(0).files[0];
      
      if (!oSpriteXY.rFilter.test(oFile.type)) 
      {
          alert("You must select a valid image file!"); return; 
      }
      
      oSpriteXY.oFReader.readAsDataURL(oFile);
      
    };
    


    /* Start : Code to pin info panel */
    
    var windowScrollTop = "",
        infoPanelTop    = 120;
    
    function relocateInfoPanel() 
    {
      //console.log("Calling relocateInfoPanel");  
      windowScrollTop  = parseInt($(window).scrollTop());
      //infoPanelTop = _this.$infoPanel.offset().top;
     // console.log(windowScrollTop + " " + infoPanelTop + " " + _this.$infoPanel.hasClass('is-pinned'));
      if (windowScrollTop > 120) 
      {
        if(!_this.$infoPanel.hasClass('is-pinned'))
        {
           _this.$infoPanel.addClass('is-pinned');
        }
      } 
      else 
      {
        _this.$infoPanel.removeClass('is-pinned');
      }  
    }
  
    //console.log("Init scroll");
    $(window).scroll(relocateInfoPanel);
    $(window).bind("resize",relocateInfoPanel);
        
    
    /* End : Code to pin info panel */    
    
    
}

/* * * 
 * Check if the browser supports HTML5 File reader feature.
 *
 */
 
if(window.FileReader)
{
    $("body").removeClass("no-filereader");
}

var oSpriteXY = new SpriteXY();
oSpriteXY.init();
    