@extends('layouts.main')

@section ('styles')
    <link rel="stylesheet" href="{{ asset('cms/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/plugins/tokenfield-bootstrap/css/bootstrap-tokenfield.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/plugins/tokenfield-bootstrap/css/tokenfield-typeahead.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/plugins/datepicker/datepicker3.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/iCheck/all.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css') }}">
    <link href="{{ asset('cms/plugins/kartik-v-bootstrap-fileinput/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
@endsection

@section ('content')
    <div class="row">
        <div class="col-sm-12">

            {{-- FILM BASIC INFO --}}
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Film</h3>
                    <div class="box-tools">
                        <button class="btn btn-primary btn-sm btn-flat js-edit_film" data-id="{{ $Film->id }}"><i class="fa fa-pencil"></i> Edit Film Information</button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row js-film_primary_info_content_holder box box-solid">
                        <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label for="">Title</label>
                                <h3 class="margin">
                                    <span>{{ $Film->title }}</span>
                                </h3>
                            </div>
                            
                            <div>
                                <label for="">Genre</label>
                                <h5 class="margin">
                                    {{ ($Film != NULL ? $Film->genre : 'Not yet set') }}
                                </h5>
                            </div>

                            <div>
                                <label for="">Running Time</label>
                                <h5 class="margin">
                                    {{ ($Film->running_time != NULL ? $Film->running_time : 'Not yet set') }}
                                </h5>
                            </div>
                            
                            <div>
                                <label for="">Release Status</label>
                                <h5 class="margin">
                                    {{ ($Film->release_status != NULL ? $RELEASE_STATUS[$Film->release_status] : 'Not yet set') }}
                                </h5>
                            </div>

                        </div>

                        <div class="col-sm-6">
                        
                            
                            <div>
                                <label for="">Release Date</label>
                                <h5 class="margin">
                                    {{ ($Film->release_date != NULL ? Date('d F Y', strtotime($Film->release_date)) : 'Not yet set') }}
                                    {{-- ($Film->release_date != NULL ? Date('l, jS \of F Y', strtotime($Film->release_date)) : 'Not yet set') --}}
                                </h5>
                            </div>
                            
                            <div>
                                <label for="">Ratings</label>
                                <h5 class="margin">
                                    {{ ( $Film->rating ? $RATINGS[$Film->rating] : 'Not yet set' ) }}
                                </h5>
                            </div>

                            
                            <div>
                                <label for="">Sell Sheet</label>
                                <h5 class="margin">
                                    {{ ($Film->sell_sheet != NULL ? $Film->sell_sheet : 'None uploaded') }}
                                </h5>
                            </div>

                            <div>
                                <label for="">Hash Tags</label>
                                <h5 class="margin">
                                    @if($Film->hash_tags != NULL)
                                       <?php
                                            //$hash_tags_arr = explode(',', $Film->hash_tags);
                                        ?>
                                            <span class="text-light-blue">{{ $Film->hash_tags }}</span>
                                        {{-- @foreach($hash_tags_arr as $val)
                                            <span class="text-light-blue">{{ $val }}</span>
                                        @endforeach --}}
                                    @endif
                                </h5>
                            </div>

                            <div>
                                <label for="">Social media urls</label>
                                <h5 class="margin">
                                    @if($Film->links != NULL)
                                        @if ($Film->links->facebook_url != '')
                                            <a href="{{ $Film->links->facebook_url }}" target="_blank" class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                                        @endif
                                        
                                        @if ($Film->links->twitter_url != '')
                                            <a href="{{ $Film->links->twitter_url }}" target="_blank" class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                                        @endif
                                        
                                        @if ($Film->links->instagram_url != '')
                                            <a href="{{ $Film->links->instagram_url }}" target="_blank" class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                                        @endif
                                    @else
                                        <p>Not yet set</p>
                                    @endif
                                </h5>
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <div class="box box-solid js-film_synopsis_holder">
                                <div class="overlay hidden"><i class="fa fa-refresh fa-spin"></i></div>
                                <div class="box-body">
                                    <div class="">
                                        <label for="">Synopsis</label> <button class="btn btn-flat btn-primary btn-sm pull-right js-update_sysnopsis" data-edit="false"><i class="fa fa-pencil"></i> Update Synopsis</button>
                                    </div>
                                    <br>
                                    <blockquote class="js-film_synopsis_content_holder">
                                        <p>
                                            {!! ($Film->synopsis != NULL ? $Film->synopsis : 'Not yet populated') !!}
                                        </p>
                                    </blockquote>
                                    <div class="js-synopsis_editor" style="display:none">
                                        <textarea placeholder="Write synopsis" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="js-synopsis_textarea" id="js-synopsis_textarea" cols="30" rows="10" class="js-wysiwyg_editor">{{ ($Film->synopsis != NULL ? $Film->synopsis : '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            {{-- FILM BASIC INFO --}}
            
            {{-- FILM CREWS --}}
            <div class="box box-warning js-film_crew_holder">
                <div class="box-header with-border">
                    <h3 class="box-title">Film Crew</h3>
                    <div class="box-tools"><button class="btn btn-flat btn-primary btn-sm js-btn_manage_people"><i class="fa fa-pencil"></i> Manage</button></div>
                </div>
                <div class="overlay hidden"><i class="fa fa-refresh fa-spin"></i></div>
                <div class="box-body ">
                    <div class="row ">
                            <div class="col-sm-12">
                                @if ($FilmCrew)
                                    @foreach($PERSON_ROLES as $key => $val)
                                        <div>
                                            <strong>{{ $val }}</strong>
                                            {{-- {{ json_encode($Person) }} --}}
                                            <p>
                                                <?php 
                                                    $c = $FilmCrew->filter(function ($crew) use($key) {
                                                                return $crew->role == $key;
                                                    }); 
                                                ?>
                                                @if ($c->count() > 0)
                                                    @foreach ($c as $crew)
                                                        {{ $crew->person->name }},
                                                    @endforeach
                                                @else
                                                    <p>No crew for this role</p>
                                                @endif
                                            </p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        
                    </div>
                </div>
            </div>
            {{-- FILM CREWS --}}

            {{-- TRAILER --}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Trailers</h3>
                    <div class="box-tools">
                        <button class="btn btn-sm btn-flat btn-primary js-trailer_add_form"><i class="fa fa-plus"></i> Add Trailer</button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="js-content_holder_trailer box box-solid">
                        <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <th>Featured</th>
                                <th>Preview Image</th>
                                <th>URL</th>
                                <th>Actions</th>
                            </tr>
                            <tbody class="js-sortable_container">
                                @if($Film->trailers)
                                    @foreach($Film->trailers as $trailer)
                                        @if($trailer->trailer_show != 0)
                                            <tr data-id="{{$trailer->id}}">
                                                <td>
                                                    <label>
                                                        <input type="checkbox" class="minimal-green js-check_hide_show" {{ ($trailer->trailer_show == 1 ? 'checked' : '') }} > 
                                                    </label>
                                                </td>
                                                <td><img class="media-object" width="160" height="90" src="{{ asset('content/film/trailers/' . $trailer->image_preview) }}" alt="..."></td>
                                                <td> <a href="{{$trailer->trailer_url}}" target="_blank">{{ str_limit($trailer->trailer_url, 60) }}</a> </td>
                                                <td>
                                                    <!-- Single button -->
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#" class="js-edit_trailer" data-id="{{ $trailer->id }}">Edit</a></li>
                                                            <li><a href="#" class="js-delete_trailer" data-id="{{ $trailer->id }}">Delete</a></li>
                                                            {{-- <li role="separator" class="divider"></li>
                                                            <li><a href="#">View</a></li> --}}
                                                        </ul>
                                                    </div>  
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <div class="callout callout-success">
                            <h5>Instructions : </h5>
                            <ol>
                                <li>Tick/untick the checkbox to show/hide the trailer in the Trailers Page of the website, respectively.</li>
                                <li>Drag the row to arrange the order of the trailers of how it will appear in the website.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- TRAILER --}}


            {{-- POSTER PREVIEW --}}
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Poster</h3>
                    <div class="box-tools">
                        <button class="btn btn-sm btn-flat btn-primary js-manage_poster_images">Manage Posters</button>
                    </div>
                </div>
                <div class="box-body js-poster_content_holder box box-solid">
                    <div class="overlay hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="js-poster_container row ">
                        @if($Poster)
                            @foreach($Poster as $data)
                                <div class="col-xs-6 col-md-3">
                                    <div href="#" data-id="{{ $data->id }}" class="thumbnail">
                                        <img alt="..." data-id="{{ $data->id }}" src="{{ asset('content/film/posters/' . $data->label) }}" style="cursor:pointer" class="js-image_item margin">
                                        @if($data->featured == 1)
                                            <span class="badge bg-red">Featured</span>
                                        @else
                                            <span class="">&nbsp;</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="box-footer">
                    <div class="callout callout-success">
                        <h5>Instructions : </h5>
                        <ol>
                            <li>Double-click on a poster to use it as the Main Poster for the film.</li>
                            <li>Drag & drop posters to re-order as to how it would appear when viewing as a gallery.Click MANAGE POSTERS to add or remove image/s.</li>
                            <li>Click the TRASH ICON in the MANAGE POSTERS MODAL to remove the image/s.</li>
                        </ol>
                    </div>
                </div>
            </div>
            {{-- POSTER PREVIEW --}}

            {{-- AWARDS --}}
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Awards</h3>
                    <div class="box-tools">
                        <button class="btn btn-sm btn-flat btn-primary js-add_award"><i class="fa fa-plus"></i> Add Award</button>
                    </div>
                </div>
                <div class="box-body js-award_content_holder box box-solid">
                    <div class="overlay hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Image Title</td>
                                <td>Image Preview</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody class="js-awards_sortable_container">
                            @if($Award->count())
                                @foreach($Award as $data)
                                    <tr data-id="{{ $data->id }}">
                                        <td>{{ $data->award_name }}</td>
                                        <td> <img class="media-object" width="64" height="64" src="{{ asset('content/film/awards/' . $data->award_image) }}" alt="..."></td>
                                        <td>
                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" class="js-edit_award" data-id="{{ $data->id }}">Edit</a></li>
                                                    <li><a href="#" class="js-delete_award" data-id="{{ $data->id }}">Delete</a></li>
                                                    {{-- <li role="separator" class="divider"></li>
                                                    <li><a href="#">View</a></li> --}}
                                                </ul>
                                            </div>  
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @else
                            <tr>
                                <td colspan="3">No data found.</td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="box-footer">
                    <p>Note : </p>
                    <p class="text-primary">Drag the image to arrange the order.</p>
                </div>
            </div>
            {{-- AWARDS --}}

            {{-- PHOTOS --}}
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Film Photos</h3>
                    <div class="box-tools">
                        <button class="btn btn-sm btn-flat btn-primary js-manage_photo_single"><i class="fa fa-plus"></i> Add Photo</button>
                        {{-- <button class="btn btn-sm btn-flat btn-primary js-manage_photo_multi">Manage Multiple Photo</button> --}}
                    </div>
                </div>
                <div class="box-body js-film_photo_content_holder box box-solid">
                    <div class="overlay hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="js-photo_container row ">
                        @if($Photo->count() > 0)
                            @foreach($Photo as $data)
                                <div class="col-xs-6 col-md-3">
                                    <div  data-id="{{ $data->id }}" class="thumbnail js-film_photo_item">
                                        <img style="cursor:pointer" alt="..." data-id="{{ $data->id }}" src="{{ asset('content/film/photos/' . $data->filename) }}" class=" margin">
                                        <span class="caption text-center">
                                        <h4>{{ $data->title }}</h4>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-sm-12">
                                <h5>No photo yet</h5>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="box-footer">
                    <p>Note : </p>
                    <p class="text-primary">Double click the poster to edit data.</p>
                    <p class="text-primary">Drag the image posters to arrange the order.</p>
                </div>
            </div>
            {{-- PHOTOS --}}

            {{-- QUOTE --}}
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Film Quote</h3>
                    <div class="box-tools">
                        <button class="btn btn-sm btn-flat btn-primary js-managa_quote"><i class="fa fa-pencil"></i> Update Quote</button>
                        {{-- <button class="btn btn-sm btn-flat btn-primary js-manage_photo_multi">Manage Multiple Photo</button> --}}
                    </div>
                </div>
                <div class="box-body js-film_quote_content_holder box box-solid">
                    <div class="overlay hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-body">
                        @if ($Quote)
                            <blockquote>
                                <p>{{ ($Quote ? $Quote->main_quote : 'Not yet set') }}</p>
                                <small>{{ $Quote->name_of_person }} <cite title="{{ $Quote->url }}"><a href="{{ $Quote->url }}" target="_blank">source</a></cite></small>
                            </blockquote>
                        @else
                            <h5>Not yet set</h5>
                        @endif
                    </div>
                </div>
                {{-- <div class="box-footer">
                    <p>Note : </p>
                    <p class="text-primary">Double click the poster to edit data.</p>
                    <p class="text-primary">Drag the image posters to arrange the order.</p>
                </div> --}}
            </div>
            {{-- QUOTE --}}

            {{-- PRESS RELEASE --}}
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Press Release</h3>
                    <div class="box-tools">
                        <button class="btn btn-sm btn-flat btn-primary js-manage_press_release"><i class="fa fa-pencil"></i> Manage Press Release</button>
                        {{-- <button class="btn btn-sm btn-flat btn-primary js-manage_photo_multi">Manage Multiple Photo</button> --}}
                    </div>
                </div>
                <div class="box-body js-film_press_release_content_holder box box-solid">
                    <div class="overlay hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-body">
                        
                        @if ($PressRelease)
                            <ul class="media-list">
                                <li class="media">
                                    <div class="media-left">
                                    <a>
                                        <img class="media-object" style="max-width:220px;" src="{{ asset('content/film/press_release' . '/' . $PressRelease->article_image) }}" alt="...">
                                    </a>
                                    </div>
                                    <div class="media-body">
                                    <h4 class="media-heading">Article</h4>
                                        <div>
                                            <label for="">Blurb</label>
                                            <div class="margin">
                                                {!! str_limit($PressRelease->blurb, 200) !!}
                                            </div>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                            <div>
                                <label for="">Main Content</label>
                                <div class="margin">
                                    {!! str_limit($PressRelease->content, 500, '<a href="#" class="link">Read more...</a>') !!}
                                </div>
                            </div>
                        @else
                            <h5>Not yet set</h5>
                        @endif
                    </div>
                </div>
                {{-- <div class="box-footer">
                    <p>Note : </p>
                    <p class="text-primary">Double click the poster to edit data.</p>
                    <p class="text-primary">Drag the image posters to arrange the order.</p>
                </div> --}}
            </div>
            {{-- PRESS RELEASE --}}
        </div>
    </div>
    <div id="js-modal_holder"></div>
@endsection

@section('scripts')
    <script src="{{ asset('cms/plugins/Bootstrap-3-Typeahead/bootstrap3-typeahead.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('cms/plugins/tokenfield-bootstrap/bootstrap-tokenfield.js') }}"></script>
    <script src="{{ asset('cms/plugins/tokenfield-bootstrap/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('cms/plugins/kartik-v-bootstrap-fileinput/js/fileinput.js') }}"></script>
    <script src="{{ asset('cms/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>

    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('cms/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        // modal edit film info show
        $('body').on('click', '.js-edit_film', function (e) {
            e.preventDefault();

            var id = $(this).data('id');

            $.ajax({
                url : "{{ route('show_film_form') }}",
                type : 'POST',
                data : {_token : '{{ csrf_token() }}', id : id},
                success : function (data) {
                    $('#js-modal_holder').html(data);
                    $('#js-film_form_modal').modal({keyboard : false, backdrop : 'static'});
                }
            });
        });
        // form film edit save
        $('body').on('submit', '#js-film_form', function (e) {
            e.preventDefault();

            save_data($(this), "{{ route('save_film') }}", "{{ route('film_basic_info_fetch', $Film->id) }}", $('.js-film_primary_info_content_holder'));
            
        });

        var order = [];
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-green, input[type="radio"].minimal-green').iCheck({
            checkboxClass: 'icheckbox_minimal-green',
            radioClass: 'iradio_minimal-red'
        });
        $('.js-sortable_container').sortable({ 
            tolerance: 'pointer',
            update : function (event, ui) {
                order = [];

                $('.js-sortable_container tr').each( function () {
                    var id = $(this).data('id');
                    order.push(id);
                });
                
                save_order(order, "{{ route('trailer_order_save') }}");
            }
        });

        $('body').on('ifChecked', '.js-check_hide_show', function (e) {

            var id = $(this).parents('tr').data('id');
            show_hide_toggle(1, id, "{{ route('show_hide_toggle') }}")
            
        })
        $('body').on('ifUnchecked', '.js-check_hide_show', function (e) {

            var id = $(this).parents('tr').data('id');
            show_hide_toggle(2, id, "{{ route('show_hide_toggle') }}")
        })
        
        
        $('body').on('click', '.js-trailer_add_form', function () {
            show_trailer_form_modal();
        });

        $('body').on('click', '.js-edit_trailer', function (e) {
            e.preventDefault();
            var id = $(this).data(id);
            show_trailer_form_modal(id);
        });

        function show_trailer_form_modal (id)
        {
            var data='';
            if (id == '')
            {
                data = {_token:"{{ csrf_token() }}" };
            }
            else
            {
                data = {_token:"{{ csrf_token() }}", trailer_id:id};
            }

            $.ajax({
                url : "{{ route('film_trailer_form_modal') }}",
                type : 'POST',
                data : data,
                success : function (data){
                    $('#js-modal_holder').html(data);
                    $('#trailer_form_modal').modal({keyboard : false, backdrop : 'static'});
                }
            });
        }

        $('body').on('click', '.js-delete_trailer', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            bootbox.confirm({
                title: "Confirm",
                message: "Are you sure you want to delete?",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Confirm'
                    }
                },
                callback: function (result) {
                    if (result)
                    {
                        delete_record("{{ route('delete_trailer') }}", "{{ route('film_trailer_fetch_record', $Film->id) }}", $('.js-content_holder_trailer'), id);
                    }
                }
            });
        });

        $('body').on('submit', '#js-frm_trailer', function (e) {
            e.preventDefault();
            save_data($(this), "{{ route('save_trailer', $Film->id) }}", "{{ route('film_trailer_fetch_record', $Film->id) }}", $('.js-content_holder_trailer'));
        });

        $('body').on('click', '#js-sellsheet', function () {
            $('#image_preview').click();
        });
        
        $('body').on('change', '#image_preview', function () {
            $('#js-image_preview_text').val($('#image_preview').val().replace(/.*(\/|\\)/, ''));
        });

        function show_hide_toggle(is_show, id, show_hide_route)
        {
            
            $.ajax({
                url : show_hide_route,
                type : 'POST',
                dataType : 'JSON',
                data : {_token:'{{ csrf_token() }}', id:id, is_show:is_show},
                success : function (data) {
                    if (data.errCode == 1)
                    {
                        //var msg = data.message;
                        //show_message (msg, 'danger') 
                    }
                    else
                    {
                        //var msg = data.message;
                        //show_message (msg, 'success') 
                    }
                }
            });
        }

        function save_order (order, order_route, targetElem)
        {
            if (order.length < 1)
            {
                var msg = 'No order has been change yet.';
                show_message (msg, 'warning', targetElem) 
                return;
            }

            $.ajax({
                url : order_route,
                type : 'POST',
                dataType : 'JSON',
                data : {_token:'{{ csrf_token() }}', order:order},
                success : function (data) {
                    //var msg = 'Trailers successfully ordered.';
                    //show_message (msg, 'success') 
                }
            });
        }


        /*
         *  POSTER JS
         */
         
         $('.js-poster_container').sortable({ 
            tolerance: 'pointer',
            update : function (event, ui) {
                var poster_order = [];

                $('.js-poster_container .thumbnail img').each( function () {
                    var id = $(this).data('id');
                    poster_order.push(id);
                });
                
                save_order(poster_order, "{{ route('posters_order_save') }}");
            }
        });

         $('body').on('dblclick', '.js-image_item', function (e) {
             e.preventDefault();
             var id = $(this).data('id');
             $('.thumbnail').children('span').removeClass('badge bg-red').html('&nbsp;');
             $(this).parents('.thumbnail').children('span').addClass('badge bg-red').text('Featured');

             $.ajax({
                 url : "{{ route('set_featured_image') }}",
                 type : 'POST',
                 data : { _token : "{{ csrf_token() }}", id : id, film_id : {{ $Film->id }} },
                 success : function (data) {
                 }
             });
         });

         $('body').on('click', '.js-manage_poster_images', function () {
            
            $.ajax({
                url : "{{ route('poster_image_modal') }}",
                type : 'POST',
                data : { _token : '{{ csrf_token() }}', film_id : {{ $Film->id }} } ,
                success : function (data) {
                    $('#js-modal_holder').html(data);
                    $('#js-poster_image_modal').modal({keyboard : false, backdrop : 'static'});
                }
            });
         });
         
        // Clear modal on hidden
        $('body').on('hidden.bs.modal', '#js-poster_image_modal', function (e) {
            $('#js-modal_holder').empty();
            if ($(this).data('id') !== undefined) // allow refresh of image list only if the modal upload was shown
            {
                var dataParams = { fetching_route : "{{ route('poster_image_fetch') }}", targetElement : 'js-poster_content_holder', extra : {{ $Film->id }} };
                image_list(dataParams);
            }
        })

        /*
         * AWARDS JS SCRIPT
         */
        $('.js-awards_sortable_container').sortable({ 
            tolerance: 'pointer',
            update : function (event, ui) {
                var award_order = [];

                $('.js-awards_sortable_container tr').each( function () {
                    var id = $(this).data('id');
                    award_order.push(id);
                });
                
                save_order(award_order, "{{ route('film_award_order_save') }}");
            }
        });

        $('body').on('click', '.js-add_award, .js-edit_award', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            show_award_form_modal(id);
        });
       
        $('body').on('click', '#js-btn_award_image', function () {
            $('#award_image').click();
        });
        
        $('body').on('change', '#award_image', function () {
            $('#js-text_award_image').val($('#award_image').val().replace(/.*(\/|\\)/, ''));
        });

        $('body').on('submit', '#js-frm_award', function (e) {
            e.preventDefault();
            save_data($(this), "{{ route('film_award_save', $Film->id) }}", "{{ route('film_awards_fetch', $Film->id) }}", $('.js-award_content_holder'));
        });

        function show_award_form_modal (id)
        {
            var data='';
            if (id == '')
            {
                data = {_token:"{{ csrf_token() }}" };
            }
            else
            {
                data = {_token:"{{ csrf_token() }}", award_id:id};
            }
            
            $.ajax({
                url : "{{ route('film_award_form') }}",
                type : 'POST',
                data : data,
                success : function (data) {
                    $('#js-modal_holder').html(data);
                    $('#js-award_form_modal').modal({keyboard : false, backdrop : 'static'});
                }
            })
        }
        $('body').on('click', '.js-delete_award', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            delete_record ("{{ route('film_award_delete') }}", "{{ route('film_awards_fetch', $Film->id) }}", $('.js-award_content_holder'), id)
        });

        /*
         * FILM PHOTO
         */
         
        $('.js-photo_container').sortable({ 
            tolerance: 'pointer',
            update : function (event, ui) {
                var photo_order = [];

                $('.js-photo_container .thumbnail img').each( function () {
                    var id = $(this).data('id');
                    photo_order.push(id);
                });
                
                save_order(photo_order, "{{ route('film_photo_order_save') }}");
            }
        });

        $('body').on('click', '.js-manage_photo_single', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            show_photo_single_form_modal(id);
        });

        function show_photo_single_form_modal (id)
        {
            var data='';
            if (id == '')
            {
                data = {_token:"{{ csrf_token() }}" };
            }
            else
            {
                data = {_token:"{{ csrf_token() }}", photo_id:id};
            }

            $.ajax({
                url : "{{ route('film_photo_single_upload_form_modal') }}",
                type : 'POST',
                data : data,
                success : function (data){
                    $('#js-modal_holder').html(data);
                    $('#js-film_photo_single_form_modal').modal({keyboard : false, backdrop : 'static'});
                }
            });
        }

        $('body').on('click', '#js-btn_image_filename', function () {
            $('#image_filename').click();
        });
        
        $('body').on('change', '#image_filename', function () {
            $('#js-text_image_filename').val($('#image_filename').val().replace(/.*(\/|\\)/, ''));
        });

        $('body').on('submit', '#js-frm_film_photo', function (e) {
            e.preventDefault();
            save_data($(this), "{{ route('film_photo_single_save', $Film->id) }}", "{{ route('film_photo_fetch', $Film->id) }}", $('.js-film_photo_content_holder'));
        });

        $('body').on('dblclick', '.js-film_photo_item', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log(id);
            show_photo_single_form_modal(id);
        });
        
        $('.bootbox').on('hidden.bs.modal', function (e) {
            alert('fasf');
            if($('.modal.in')){
                $('body').addClass('modal-open');
            }
        });

        $('body').on('click', '.js-photo_delete', function (e) {
            e.preventDefault();

            var id = $(this).data('id');
            bootbox.confirm({
                message: "Are you sure you want to delete photo?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-danger btn-flat'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-default btn-flat'
                    }
                },
                callback: function (result) {
                    console.log('This was logged in the callback: ' + result);
                    if(result)
                    {
                        $.ajax({
                            url : "{{ route('photo_single_delete') }}",
                            type : 'POST',
                            data : {_token : '{{ csrf_token() }}', id : id},
                            success     : function (data) {
                                if (data.errCode == 1)
                                {
                                    show_message (data.messages, 'danger');
                                }
                                else if (data.errCode == 2)
                                {
                                    $('#general-error').append('<code>'+ data['messages'] +'</code>');
                                }
                                else
                                {
                                    $('#js-film_photo_single_form_modal').modal('hide');
                                    fetch_record("{{ route('film_photo_fetch', $Film->id) }}", $('.js-film_photo_content_holder'), 1, '');
                                }
                            }
                        });
                    }
                    setTimeout(function(){
                        var modal_count = $('.modal-dialog').length;
                        if(modal_count > 0)
                        {
                            $('body').addClass('modal-open');
                        }
                    }, 500);  
                }
            });

        });

        $('.film').addClass('active');

        /*
         * QUOTE
         */
        $('body').on('click', '.js-managa_quote', function (e) {
            e.preventDefault();
            
            $.ajax({
                url : "{{ route('film_quote_form_modal') }}",
                type : 'POST',
                data : { _token:'{{ csrf_token() }}', film_id : {{ $Film->id }} },
                success : function (data) {
                    $('#js-modal_holder').html(data);
                    $('#js-film_quote_form_modal').modal({keyboard : false, backdrop : 'static'});
                }
            });
        });
        
        $('body').on('submit', '#js-frm_quote', function (e) {
            e.preventDefault();
            save_data($(this), "{{ route('film_quote_save') }}", "{{ route('film_quote_fetch', $Film->id) }}", $('.js-film_quote_content_holder'));
        });
        
        /*
         * UPDATE SYNOPSIS
         */
        $('body').on('click', '.js-update_sysnopsis', function (e) {
            e.preventDefault();
            $(".js-synopsis_editor ul.wysihtml5-toolbar").hide();

            if ($(this).data('edit') == true)
            {
                var synopsis = $(".js-wysiwyg_editor").val();
                $('.js-film_synopsis_holder').children('.overlay').removeClass('hidden');
                $.ajax({
                    url : "{{ route('film_synopsis_save') }}",
                    type : 'POST',
                    dataType : 'JSON',
                    data : {_token:'{{ csrf_token() }}', synopsis:synopsis, id:{{ $Film->id }} },
                    success : function (data) {
                        $('.js-film_synopsis_holder').children('.overlay').addClass('hidden');

                        $('.js-film_synopsis_content_holder').html(synopsis);

                        $('.js-film_synopsis_content_holder').slideToggle();
                        $('.js-synopsis_editor').slideToggle();

                    }
                });
            }
            else
            {
                $('.js-film_synopsis_content_holder').slideToggle();
                $('.js-synopsis_editor').slideToggle();
            }
            
                $(this).data('edit', !$(this).data('edit'));
                $(this).html( ($(this).data('edit') == true ? '<i class="fa fa-save"></i> Save Synopsis' : '<i class="fa fa-pencil"></i> Update Synopsis') );
        });

        //bootstrap WYSIHTML5 - text editor
        $(".js-wysiwyg_editor").wysihtml5();
        //$.ajax();

        /*
         * PRESS RELEASE
         */
        $('body').on('click', '.js-manage_press_release', function () {

            $.ajax({
                url : "{{ route('film_press_release_form_modal', $Film->id) }}",
                type : 'POST',
                data : { _token : "{{ csrf_token() }}", id : {{ $Film->id }} },
                success : function (data) {
                    $('#js-modal_holder').html(data);
                    $('#js-film_press_release_form_modal').modal({keyboard : false, backdrop : 'static'});
                    
                    $("#press_release_blurb").wysihtml5();
                    $("#press_release_content").wysihtml5();
                    $("#js-frm_press_release ul.wysihtml5-toolbar").addClass('hidden');
                }
            });
        });
        
        $('body').on('click', '#js-press_release_article_image', function (e) {
            e.preventDefault();
            $('#press_release_article_image').click();
        });

        $('body').on('change', '#press_release_article_image', function () {
            $('#js-text_press_release_article_image').val($('#press_release_article_image').val().replace(/.*(\/|\\)/, ''));
        });

        $('body').on('submit', '#js-frm_press_release', function (e) {
            e.preventDefault();
            save_data($(this), "{{ route('film_press_release_save') }}", "{{ route('film_press_release_fetch', $Film->id) }}", $('.js-film_press_release_content_holder'));
        });

        $('body').on('click', '.js-delete_press_release', function (e) {
            e.preventDefault();

            var id = $(this).data('id');
            bootbox.confirm({
                message: "Are you sure you want to delete press release details?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-danger btn-flat'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-default btn-flat'
                    }
                },
                callback: function (result) {
                    if(result)
                    {
                        $.ajax({
                            url : "{{ route('film_press_release_delete') }}",
                            type : 'POST',
                            data : {_token : '{{ csrf_token() }}', id : id, film_id : "{{ $Film->id }}"},
                            success     : function (data) {
                                if (data.errCode == 1)
                                {
                                    show_message (data.messages, 'danger');
                                }
                                else if (data.errCode == 2)
                                {
                                    $('#general-error').append('<code>'+ data['messages'] +'</code>');
                                }
                                else
                                {
                                    $('#js-film_press_release_form_modal').modal('hide');
                                    fetch_record("{{ route('film_press_release_fetch', $Film->id) }}", $('.js-film_press_release_content_holder'), 1, '');
                                }
                            }
                        });
                    }
                    setTimeout(function(){
                        var modal_count = $('.modal-dialog').length;
                        if(modal_count > 0)
                        {
                            $('body').addClass('modal-open');
                        }
                    }, 500);  
                }
            });
        }); 


        /*
         * FILM CREW
         */
        
        // Show Film Crew Form Modal
        $('body').on('click', '.js-btn_manage_people', function (e) {
            e.preventDefault();
           
            $.ajax({
                url : "{{ route('film_crew_form_modal') }}",
                type : 'POST',
                data : { _token:'{{ csrf_token() }}', film_id : {{ $Film->id }} },
                success : function (data) {
                    $('#js-modal_holder').html(data);
                    $('#js-film_crew_form_modal').modal({keyboard : false, backdrop : 'static'});
                    
                    $('.tokenfield-typeahead').tokenfield();
                }
            });
        })

        $('body').on('submit', '#js-frm_film_crew', function (e) {
            e.preventDefault();
            save_data($(this), "{{ route('film_crew_save') }}", "{{ route('film_crew_data_fetch', $Film->id) }}", $('.js-film_crew_holder'));
             
        });
    </script>
@endsection

