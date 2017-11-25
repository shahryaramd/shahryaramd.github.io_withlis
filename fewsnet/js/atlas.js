jQuery(document).ready(function($) {
    $('.toggleMe').click(function() {
        $('#agrmet .panelmap').toggle('slow');
    });
    $('table tr:not(.showing)').click(function() {
        $(this).find("td").toggleClass('inactive');
        $(this).find("img").toggle();
    });
});

/**
 * Swap Timeseries images.
 */
function swapTime(element)  {
   jQuery(".time td img").each(function() {
      var path   = jQuery(this).attr('src');
      var pos    = path.lastIndexOf("/");
      var dir    = path.substr(0, pos);
      var base   = path.substr(pos);
      var end    = base.indexOf('_');
      var suffix = base.substr(end);
      var src    = dir + '/' + element + suffix;

      jQuery(this).attr('src', src);
   });   
}
/**
 * Swap Spacial imagery.
 */
function swapSpace(element) {
   jQuery(".space img").each(function() {
      var path   = jQuery(this).attr('src');
      if (path == '/sites/default/files/private/Benchmarking/blankimage.png') {
          var strpos = path.lastIndexOf('/');
          path = path.substr(0, strpos);
          
          var next = jQuery(this).parent().next().find('img').attr('src');
          if (next == undefined) {
              next = jQuery(this).parent().prev().find('img').attr('src');
          }
          if (next == undefined) {
              path = '/sites/default/files/private/Benchmarking/blankimage.png'
          } else {
              strpos   = next.lastIndexOf('/');
              var dir  = next.substr(0, strpos);  // dirname
              next     = next.substr(strpos+1);   // basename
              var year = next.substr(0, 4);       // year
              strpos   = next.indexOf('_'); 
              strpos2  = next.lastIndexOf('_');   // exclude sibling column. 
              path     = dir + "/" + year + element + next.substr(strpos, strpos2) + ".png";
          }
      } else {
          var pos    = path.lastIndexOf("/");
          var dir    = path.substr(0, pos+5);
          var end    = path.substr(pos+5);
          var pos2   = end.indexOf("_");
          path       = dir + element + end.substr(pos2);;
      }
      jQuery(this).attr('src', path).error(function() {
          jQuery(this).attr('src', '/sites/default/files/private/Benchmarking/blankimage.png');
      });
   });   
}
