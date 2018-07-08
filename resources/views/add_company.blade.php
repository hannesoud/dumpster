@extends('layouts.app')
@section('title')
    Create Company
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Company</div>
                    <div class="panel-body">

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        {{ session('error') }}

                        <form method="POST" action="{{ url('/create_company_submit') }}" enctype="multipart/form-data"
                              class="form-horizontal">

                            {{ csrf_field() }}


                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Name*</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('web_site') ? ' has-error' : '' }}">
                                <label for="web_site" class="col-md-4 control-label">Website</label>

                                <div class="col-md-8">
                                    <input id="web_site" type="url" class="form-control" name="web_site"
                                           value="{{ old('web_site') }}">

                                    @if ($errors->has('web_site'))
                                        <span class="help-block"><strong>{{ $errors->first('web_site') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Company Email*</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('license_number') ? ' has-error' : '' }}">
                                <label for="license_number" class="col-md-4 control-label">License Number*</label>

                                <div class="col-md-8">
                                    <input id="license_number" type="text" class="form-control" name="license_number"
                                           value="{{ old('license_number') }}" required>

                                    @if ($errors->has('license_number'))
                                        <span class="help-block"><strong>{{ $errors->first('license_number') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description*</label>

                                <div class="col-md-8">
                                    <input id="description" type="text" class="form-control" name="description"
                                           value="{{ old('description') }}" required>

                                    @if ($errors->has('description'))
                                        <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Address*</label>

                                <div class="col-md-8">
                                    <input id="address" type="text" class="form-control" name="address"
                                           value="{{ old('address') }}" required>

                                    @if ($errors->has('address'))
                                        <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                                <label for="latitude" class="col-md-4 control-label text-left">Latitude*</label>
                                <div class="col-md-8">
                                    <input id="latitude" type="text" class="form-control" name="latitude"
                                           value="{{ old('latitude') }}" required>
                                    @if ($errors->has('latitude'))
                                        <span class="help-block"><strong>{{ $errors->first('latitude') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                                <label for="longitude" class="col-md-4 control-label text-left">Longitude*</label>
                                <div class="col-md-8">
                                    <input id="longitude" type="text" class="form-control" name="longitude"
                                           value="{{ old('longitude') }}" required>
                                    @if ($errors->has('longitude'))
                                        <span class="help-block"><strong>{{ $errors->first('longitude') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div id="googleMap" style="height: 400px; width: 100%;margin-bottom:30px;"></div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label text-left">Phone Number*</label>

                                <div class="col-md-8">
                                    <input id="phone" type="tel" class="form-control" name="phone"
                                           value="{{ old('phone') }}" pattern="\d{3}[\-]\d{3}[\-]\d{4}"
                                           title="US based Phone number in the format of : xxx-xxx-xxxx" required>
                                    <sub><i>Please input US based Phone number in the format of : xxx-xxx-xxxx</i></sub>
                                    @if ($errors->has('phone'))
                                        <span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('avatar_image') ? ' has-error' : '' }}">
                                <label for="avatar_image" class="col-md-4 control-label">Avatar Image*</label>

                                <div class="col-md-8">
                                    <input id="avatar_image" type="file" class="form-control"
                                           name="avatar_image" required>
                                    @if ($errors->has('avatar_image'))
                                        <span class="help-block"><strong>{{ $errors->first('avatar_image') }}</strong></span>
                                    @endif
                                    <span id="show_error" class="text-danger" style="display:none;">Please choose other file.</span>
                                    <span class="text-info">Maximum File Size : 4MB </span>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary" id="submit">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>
        $(document).on("keypress", 'form', function (e) {
            var code = e.keyCode || e.which;
            if (code == 13) {
                e.preventDefault();
                return false;
            }
        });
    </script>
    <script>

        $("#avatar_image").change(function () {
            if (fileExtValidate(this)) { // file extension validation function
                if (fileSizeValidate(this)) { // file size validation function
                    $('#submit').prop('disabled', false);
                    $('#show_error').hide();
                } else {
                    $('#submit').prop('disabled', true);
                }
            } else {
                $('#submit').prop('disabled', true);
            }
        });
        // function for  validate file extension
        var validExt = ".png, .gif, .jpeg, .jpg";
        function fileExtValidate(fdata) {
            var filePath = fdata.value;
            var getFileExt = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
            var pos = validExt.indexOf(getFileExt);
            if (pos < 0) {
                alert("This file is not allowed, please upload valid file.");
                $('#show_error').show();
                return false;
            } else {
                return true;
            }
        }
        //function for validate file size: 4MB
        //var maxSize = 4;
        var maxSize = 1024*1024*4;
        function fileSizeValidate(fdata) {
            if (fdata.files && fdata.files[0]) {
                //var fsize = Math.ceil((fdata.files[0].size / 1024 )/1024);
                var fsize = fdata.files[0].size;//Math.ceil((fdata.files[0].size / 1024 )/1024);
                if (fsize > maxSize) {
                    alert('Maximum file size exceed, This file size is bigger than 4MB.');
                    $('#show_error').show();
                    return false;
                } else {
                    return true;
                }
            }
        }
    </script>
    <script>

        var lat = parseFloat(40.6244927);
        var lng = parseFloat(-74.2741073);

        var address = document.getElementById('address').value;

        var marker;
        var markers = [];
        var map;
        var infoWindow;
        var geocoder;

        //init map
        function initMap() {

            geocoder = new google.maps.Geocoder();

            var company_position = new google.maps.LatLng(lat, lng);
            var mapProp = {
                center: company_position,
                zoom: 17
            };
            map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            marker = new google.maps.Marker({position: company_position});
            infoWindow = new google.maps.InfoWindow;


            marker.setMap(map);
            if (address) {
                infoWindow.setContent(address);
                infoWindow.open(map, marker);
            }

            google.maps.event.addListener(map, 'click', function (event) {
                marker.position = event.latLng;
                marker.setMap(map);
                setLatLong(event.latLng.lat(), event.latLng.lng());

                //get possible address for this coords
                geocodeLatLng(geocoder, map, infoWindow);
            });


//            // Try HTML5 geolocation.
//            if (navigator.geolocation) {
//                navigator.geolocation.getCurrentPosition(function (position) {
//                    var pos = {
//                        lat: position.coords.latitude,
//                        lng: position.coords.longitude
//                    };
//
//                    infoWindow.setPosition(pos);
//                    infoWindow.setContent('Location found.');
//                    infoWindow.open(map);
//                    map.setCenter(pos);
//                }, function () {
//                    handleLocationError(true, infoWindow, map.getCenter());
//                });
//            } else {
//                // Browser doesn't support Geolocation
//                handleLocationError(false, infoWindow, map.getCenter());
//            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }

        //Address -> lat, long
        function addressToLatLong() {
            address = document.getElementById('address').value;
            geocoder.geocode({'address': address}, function (results, status) {
                if (status == 'OK') {
                    map.setCenter(results[0].geometry.location);
                    var newPosition = results[0].geometry.location;
//                    marker = new google.maps.Marker({
//                        map: map,
//                        position: newPosition
//                    });

                    marker.position = newPosition;
                    marker.setMap(map);

                    if (address) {
                        infoWindow.setContent(address);
                        infoWindow.open(map, marker);
                    }

                    var newlat = newPosition.lat();
                    var newlong = newPosition.lng();

                    setLatLong(newlat, newlong);
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }

        //lang, long -> address
        function geocodeLatLng(geocoder, map, infowindow) {
            var glng = document.getElementById("longitude").value;
            var glat = document.getElementById("latitude").value;

            var latlng = {lat: parseFloat(glat), lng: parseFloat(glng)};

            geocoder.geocode({'location': latlng}, function (results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        var gaddress = results[0].formatted_address;
                        infowindow.setContent(gaddress);
                        infowindow.open(map, marker);

                        var address_input = document.getElementById("address");
                        //disable onchange event
                        $(address_input).unbind('change');

                        address_input.value = gaddress;

                        //enable onchange event
                        $(address_input).bind('change');

                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
        }

        //set lang and long on input
        function setLatLong(lat, long) {
            var oLat = document.getElementById("latitude");
            var oLng = document.getElementById("longitude");
            oLat.value = lat;
            oLng.value = long;
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCR2vFI8XLIxAQuI-Xa-pmHmmVAlDzdic4&callback=initMap"
            type="text/javascript"></script>

@endsection
