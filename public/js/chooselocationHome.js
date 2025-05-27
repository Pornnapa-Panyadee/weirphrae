//console.log('hello');

var ID = window.location.href.replace("https://watercenter.scmc.cmu.ac.th/weir/lampang/", "");

function Province(id, district) {
  // Empty the dropdown

  $('#weir_district').find('option').not(':first').remove();

  // AJAX request 
  $.ajax({

    url: 'https://watercenter.scmc.cmu.ac.th/weir/lampang/district/' + id,

    type: 'get',
    dataType: 'json',
    success: function (response) {

      var len = 0;
      if (response['data'] != null) {
        len = response['data'].length;
      }

      if (len > 0) {
        // Read data and create <option >
        for (var i = 0; i < len; i++) {

          var id = response['data'][i].vill_id;
          var name = response['data'][i].vill_district;
          var option = "<option value='" + name + "'>" + name + "</option>";
          $("#weir_district").append(option);
          if (district == name) {
            $('#weir_district option:contains(' + district + ')').prop({ selected: true });
          }
        }

      }

    }
  });
}


function District(id, tumbol) {


  // Empty the dropdown

  $('#weir_tumbol').find('option').not(':first').remove();

  // AJAX request 
  $.ajax({

    url: 'https://watercenter.scmc.cmu.ac.th/weir/lampang/tumbol/' + id,
    type: 'get',
    dataType: 'json',
    success: function (response) {

      var len = 0;

      if (response['data'] != null) {
        len = response['data'].length;
      }

      if (len > 0) {
        // Read data and create <option >



        for (var i = 0; i < len; i++) {

          var id = response['data'][i].vill_id;
          var name = response['data'][i].vill_tunbol;
          var option = "<option value='" + name + "'>" + name + "</option>";
          $("#weir_tumbol").append(option);
          if (tumbol == name) {
            $('#weir_tumbol option:contains(' + tumbol + ')').prop({ selected: true });
          }
        }
      }

    }
  });
}


function Tumbol(id, vill) {
  // Empty the dropdown
  $('#weir_village').find('option').not(':first').remove();

  // AJAX request 
  $.ajax({

    url: 'https://watercenter.scmc.cmu.ac.th/weir/lampang/village/' + id,
    type: 'get',
    dataType: 'json',
    success: function (response) {

      var len = 0;
      if (response['data'] != null) {
        len = response['data'].length;
      }

      if (len > 0) {
        // Read data and create <option >
        for (var i = 0; i < len; i++) {


          var name = response['data'][i].vill_name;
          var moo = response['data'][i].vill_moo;
          var village = "หมู่ที่ " + moo + " " + name;

          var option = "<option value='" + village + "'>" + village + "</option>";

          $("#weir_village").append(option);
          if (vill == village) {
            $('#weir_village option:contains(' + vill + ')').prop({ selected: true });
          }
        }
      }

    }
  });
}


$(document).ready(function () {
  // District Change

  $('#weir_province').change(function () {
    let id = $('#weir_province').val();
    //console.log(id)
    Province(id, "0");

  });

});




$(document).ready(function () {
  // District Change

  $('#weir_district').change(function () {
    let id = $('#weir_district').val();
    //console.log(id)
    District(id, "0");

  });

});


$(document).ready(function () {

  // Tombol Change
  $('#weir_tumbol').change(function () {

    // Tombol name
    var id = $(this).val();
    //var id2='แม่จัน';
    //alert(id);
    //alert(id2);
    Tumbol(id, "0");


  });

});


function District(id, tumbol) {


  // Empty the dropdown

  $('#weir_tumbolCR').find('option').not(':first').remove();

  // AJAX request 
  $.ajax({

    url: 'https://watercenter.scmc.cmu.ac.th/weir/lampang/tumbol/' + id,
    type: 'get',
    dataType: 'json',
    success: function (response) {

      var len = 0;

      if (response['data'] != null) {
        len = response['data'].length;
      }

      if (len > 0) {
        // Read data and create <option >

        var option = "<option value='sum'> ทั้งหมด</option>";
        $("#weir_tumbolCR").append(option);

        for (var i = 0; i < len; i++) {

          var id = response['data'][i].vill_id;
          var name = response['data'][i].vill_tunbol;
          option = "<option value='" + name + "'>" + name + "</option>";
          $("#weir_tumbolCR").append(option);
          if (tumbol == name) {
            $('#weir_tumbolCR option:contains(' + tumbol + ')').prop({ selected: true });
          }
        }
      }

    }
  });
}
