@extends('layouts.main')


@section ('styles')
    
    <link href="{{ asset('cms/plugins/kartik-v-bootstrap-fileinput/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
@endsection

@section ('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12 conatiner">

                    <div class="callout callout-success">
                        <h4>Instructions</h4>
                        <li>Drag & drop thumbnails to re-order slides in the HOME PAGE. Click SAVE ORDER when done.</li>
                        <li>Click MANAGE CAROUSEL to add or remove image/s.</li>
                        <li>Click the TRASH ICON in the MANAGE PHOTOS MODAL to remove the image/s.</li>
                        <li>Double-click an image to add a caption and YouTube URL. The YouTube URL is a required field; and slides without a URL will not appear in the website.</li>

                    </div>
                </div>
            </div>
            <ul class="timeline">
                <li>
                    <div class="timeline-item">
                        <span class="time">
                            
                        </span>
                        <h3 class="timeline-header">Home Page Carousel</h3>
                        <div class="timeline-body js-image_container box" style="border-top:0">
                            <div class="overlay hidden">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>
                            <div class="row sortable-container ">
                                @if($Carousel)
                                    @foreach($Carousel as $image)
                                        <div class="col-xs-6 col-md-3">
                                            <div data-id="{{ $image->id }}" class="thumbnail js-image_item" style="cursor:pointer">
                                                <img data-id="{{ $image->id }}" src="{{ asset('content/carousel/') }}/{{$image->image}}" class="js-image_item margin">
                                                <span class="caption text-center">
                                                    @if($image->caption)
                                                        <h4>{{ $image->caption }}</h4>
                                                    @else
                                                        <h4>No Caption Addedd</h4>
                                                    @endif

                                                    <p>
                                                        @if($image->url)
                                                            <a href="{{ $image->url }}" target="_blank">View the link</a>
                                                        @else
                                                            <p>No Link Added</p>
                                                        @endif
                                                    </p>
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>

                        <div class="timeline-footer">
                            <button class="btn btn-flat btn-primary" id="js-show_modal_uploader">Manage Uploads</button>
                            <button class="btn btn-flat btn-primary js-reorder_toggle" data-type="1" id="js-save_reorder_image">Save Order</button>
                        </div>
                    </div>
                </li>
            </ul>

            <div class="row">
                <div class="col-sm-12 conatiner">

                    <div class="callout callout-success">
                        <h4>Requirements</h4>
                        <ul>
                            <li>Accepted File Types: JPG / JPEG / PNG</li>
                            <li>Maximum File Size: 1 MB</li>
                            <li>Required Dimensions: 1600 x 900 pixels (width x height)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <div id="js-modal_holder"></div>
@endsection

@section ('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="{{ asset('cms/plugins/kartik-v-bootstrap-fileinput/js/fileinput.js') }}" type="text/javascript"></script>
    <script>
        var order = [];
        $('.sortable-container').sortable({ 
            tolerance: 'pointer',
            update : function (event, ui) {
                $('.sortable-container div img').each( function () {
                    var id = $(this).data('id');
                    order.push(id);
                });
            }
        });
        $('body').on('click', '#js-save_reorder_image', function () {
            if(order.length < 1)
            {
                var msg = 'No order has been change yet.';
                show_message (msg, 'warning') 
                return;
            }
            $.ajax({
                url : "{{ route('image_ordering') }}",
                type : 'POST',
                data : {_token : '{{ csrf_token() }}', order : order},
                success : function (data) {
                    console.log(data);
                }
            });

            show_message ('Order successfully arranged.', 'success') 
        })
        $('body').on('dblclick', '.js-image_item', function () {
            var id = $(this).data('id');
            $('.js-image_container .overlay').removeClass('hidden');
            $.ajax({
                url : "{{ route('image_detail_modal') }}",
                type : 'POST',
                data : {_token : '{{ csrf_token() }}', id : id},
                success : function (data) {
                    $('#js-modal_holder').append(data);
                    $('#js-image_details').modal({ keyboard : false, backdrop : 'static' });
                    $('.js-image_container .overlay').addClass('hidden');
                }
            });
        });

        $('body').on('click', '#js-show_modal_uploader', function () {
            $.ajax({
                url : "{{ route('image_uploader_modal') }}",
                type : 'POST',
                data : {  _token : '{{ csrf_token() }}'},
                success : function (data) {
                    $('#js-modal_holder').append(data);
                    $('#js-image_uploader_modal').modal({ keyboard : false, backdrop : 'static' });
                }
            });
        });

        $('body').on('submit', '#carousel_image_details', function (e) {
            e.preventDefault();

            var formData = new FormData( $(this)[0] );
            
            $('#carousel_image_details').parents('.box').children('.overlay').removeClass('hidden');
            $.ajax({
                url : "{{ route('save_image_details') }}",
                type : 'POST',
                dataType : 'JSON',
                data        : formData,
                processData : false,
                contentType : false,
                success : function (data) {
                    
                    $('.help-block').empty();
                    $('.form-group').removeClass('has-error');

                    $('#carousel_image_details').parents('.box').children('.overlay').addClass('hidden');
                    if(data.errCode == 1)
                    {
                        for(var err in data.messages)
                        {
                            if($('#'+err+'-error').length) // Checks if the element is exisiting
                            {
                                $('#'+err+'-error').html('<code>'+ data['messages'][err] +'</code>');
                                $('#'+err+'-error').parents('.form-group').addClass('has-error');
                            }
                            else
                            {
                                $('#general-error').append('<code>'+ data['messages'][err] +'</code>');
                            }
                        }
                    }
                    else
                    {
                        show_message (data.messages, 'success');
                        $('#js-image_details').modal('hide');
                    }
                }
            });
        });

        

        $('body').on('hidden.bs.modal', '#js-image_uploader_modal', function (e) {
            image_list();
        })
        
        $('.home_page_carousel').addClass('active');
    </script>
@endsection