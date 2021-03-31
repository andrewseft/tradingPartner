<div class="container-fluid">
        <div class="row clearfix">

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td width="25%">Name</td>
                                            <td>{{Helper::mb_strtolower($contactUs->name)}}</td>
                                        </tr>
                                        <tr>
                                            <td width="25%">Email</td>
                                            <td>{{$contactUs->email}}</td>
                                        </tr>
                                        <tr>
                                            <td width="25%">Number</td>
                                            <td>{{$contactUs->number}}</td>
                                        </tr>
                                        <tr>
                                            <td width="25%">Message</td>
                                            <td>{{$contactUs->message}}</td>
                                        </tr>
                                         
                                        <tr>
                                            <td style="width: 30%;">Image</td>
                                            @if(isset($contactUs->image ))
                                                <td>{!! Html::image(Helper::getImageUrl(Constant::CON_IMAGE.$contactUs->image),'user',['class'=>'','width'=>"250px"])  !!}</td>
                                            @else
                                                <td>N/A</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>