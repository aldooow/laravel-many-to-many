require('./bootstrap');
var $ = require( "jquery" );

$(document).ready(function() {

  $('.delete-car-btn').on('submit', function(){
    return confirm('Do you really want to delete this car?');
  });

  
});
