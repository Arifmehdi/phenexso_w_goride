@extends('admin.master')
@section('title',"Admin Dashboard | Website Settings")
@section('body')

<style>
.about-preview {
    max-width: 100%;     /* fit container width */
    max-height: 100%;    /* fit container height */
    object-fit: contain; /* show full image without cropping */
    display: block;
}


</style>
<div class="container-fluid pt-5">
    <div class="card card-widget">
        <div class="card-header with-border">
            <h3 class="card-title">
                Website Settings Update
            </h3>
        </div>
        <div>
       </div>
        <form action="{{ route('websiteparam.update',$websiteParameter->id) }}" enctype="multipart/form-data" method="POST">
           @csrf
            <div class="card-body" style="background-color: #ccc;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-widget">
                            <div class="card-body">
                                <div class="form-group ">
                                    <label for="website_title" class="  control-label">Website Title </label>
                                    <input type="text" name="website_title" class="form-control" value="{{ old('website_title') ?: $websiteParameter->website_title ?? '' }}" id="website_title" placeholder="Short Title for Admin Left Sidebar" autocomplete="off">
                                </div>

                                <div class="form-group ">
                                    <label for="google_search_console" class="control-label">
                                        Shipping Charge
                                    </label>
                                  <input type="text" name="shipping_cahrge" class="form-control" value="{{ old('shipping_cahrge') ?: $websiteParameter->shipping_cahrge ?? '' }}" id="shipping_cahrge" placeholder="Shipping Charge" autocomplete="off">
                                </div>

                                <div class="form-group ">
                                    <label for="google_search_console" class="control-label"> Google Search Console
                                        Code
                                    </label>
                                    <textarea name="google_search_console" class="form-control textarea" rows="7" id="google_search_console" placeholder="Job websiteParameter instraction">{{ old('google_search_console') ?: $websiteParameter->google_search_console ?? '' }}</textarea>
                                </div>

                                <div class="form-group ">
                                    <label for="google_analytics_code" class="control-label"> Google Analytics
                                        (Tracking) Code </label>
                                    <textarea name="google_analytics_code" class="form-control" rows="10" id="google_analytics_code" placeholder="Google Analytics Code (Tracking Code)">{{ old('google_analytics_code') ?: $websiteParameter->google_analytics_code ?? '' }}</textarea>

                                </div>

                                <div class="form-group ">
                                    <label for="facebook_pixel_code" class="control-label"> Facebook (Pixel) Code
                                    </label>
                                    <textarea name="facebook_pixel_code" class="form-control" rows="10" id="facebook_pixel_code" placeholder="Facebook Pixel Code (Tracking Code)">{{ old('facebook_pixel_code') ?: $websiteParameter->facebook_pixel_code ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-6">

                        <div class="card card-widget">
                            <div class="card-body">
                                <div class="form-group ">
                                    <label for="meta_author" class="  control-label">Meta Author for Website</label>
                                    <input type="text" name="meta_author" class="form-control" value="{{ old('meta_author') ?: $websiteParameter->meta_author ?? '' }}" id="meta_author" placeholder="Meta Author for SEO of website" autocomplete="off">
                                </div>

                                <div class="form-group ">
                                    <label for="meta_description" class="control-label">Meta Description </label>
                                    <textarea name="meta_description" class="form-control" rows="4" id="meta_description" placeholder="Meta Description for SEO of Website">{{ old('meta_description') ?: $websiteParameter->meta_description ?? '' }}</textarea>
                                </div>

                                <div class="form-group ">
                                    <label for="footer_copyright" class="control-label">Footer Copyright Text</label>
                                    <textarea name="footer_copyright" class="form-control" rows="4" id="footer_copyright" placeholder="Copyright text in footer area">{{ old('footer_copyright') ?: $websiteParameter->footer_copyright ?? '' }}</textarea>
                                </div>


                                <div class="form-group ">
                                    <label for="fb_url" class="  control-label">Facebook Page Url</label>
                                    <input type="text" name="fb_url" class="form-control" value="{{ old('fb_url') ?: $websiteParameter->fb_url ?? '' }}" id="fb_url" placeholder="https://facebook.com/page.username" autocomplete="off">
                                </div>

                                <div class="form-group ">
                                    <label for="contact_mobile" class="  control-label">Contact Address</label>
                                    <input type="text" name="contact_address" class="form-control" value="{{ old('contact_address') ?: $websiteParameter->contact_address ?? '' }}" id="contact_address" placeholder="+address" autocomplete="off">
                                </div>

                                <div class="form-group ">
                                    <label for="contact_mobile" class="  control-label">Contact Mobile</label>
                                    <input type="text" name="contact_mobile" class="form-control" value="{{ old('contact_mobile') ?: $websiteParameter->contact_mobile ?? '' }}" id="contact_mobile" placeholder="+055654646515" autocomplete="off">
                                </div>

                                <div class="form-group ">
                                    <label for="contact_email" class="  control-label">Contact email</label>
                                    <input type="text" name="contact_email" class="form-control" value="{{ old('contact_email') ?: $websiteParameter->contact_email ?? '' }}" id="contact_email" placeholder="example@.com" autocomplete="off">
                                </div>

                                <div class="form-group ">
                                    <label for="twitter_url" class="  control-label">Twitter Url</label>
                                    <input type="text" name="twitter_url" class="form-control" value="{{ old('twitter_url') ?: $websiteParameter->twitter_url ?? '' }}" id="twitter_url" placeholder="Twitter url" autocomplete="off">
                                </div>

                                <div class="form-group ">
                                    <label for="youtube_url" class="  control-label">Youtube Url</label>
                                    <input type="text" name="youtube_url" class="form-control" value="{{ old('youtube_url') ?: $websiteParameter->youtube_url ?? '' }}" id="youtube_url" placeholder="Youtube Url" autocomplete="off">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card card-widget">
                            <div class="card-header with-border">
                                <h3 class="card-title">Update Favicon </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group ">
                                            <label for="favicon" class="col-sm-3 control-label">favicon</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="favicon" class="" id="favicon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="w3-display-container" style="height:110px;">
                                         <img class="img-responsive" style="width: 50px;" src="{{ route('imagecache', ['template' => 'original', 'filename' => $websiteParameter->favicon()]) }}" alt="" id="showFavicon">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>
                    {{--<div class="col-sm-6">
                        <div class="card card-widget">
                            <div class="card-header with-border">
                                <h3 class="card-title">Pharmacy E-Commerce Logo  
                                    <span class="text-danger">&nbsp;&nbsp;Better Size: (140x158px)</span>
                                </h3>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group ">
                                            <label for="logo" class="col-sm-3 control-label">
                                         
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="file" name="logo" class="" id="logo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="w3-display-container" style="max-height:110px;">
                                            <img class="img-responsive" style="max-width: 100%;" src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $websiteParameter->logo()]) }}" alt="" id="showLogo">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>--}}
                    <div class="col-sm-6">
                        <div class="card card-widget">
                            <div class="card-header with-border">
                                <h3 class="card-title">Logo
                                     <span class="text-danger">&nbsp;&nbsp;Better Size: (140x132px)</span>
                                </h3>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group ">
                                            <label for="logo_alt" class="col-sm-4 control-label"></label>
                                            <div class="col-sm-8">
                                                <input type="file" name="logo_alt" class="" id="logo_alt">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="w3-display-container" style="height:110px;">
                                            <img class="img-responsive" style="max-width: 100%;" src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $websiteParameter->logo_alt()]) }}" alt="" id="showLogoAlt">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
                
                <!-- about section Start -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-widget">
                            <div class="card-header with-border">
                                <h3 class="card-title">About Us</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- About Us English -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="about_title" class="control-label">Who We Are Title</label>
                                            <input type="text" name="about_title" class="form-control"  id="about_title" placeholder="About Title" value="{{ old('about_title') ?: $websiteParameter->about_title ?? '' }}">
                                        </div>
                                    </div>
                                    
                                    <!-- About Us Bangla -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="about_subtitle" class="control-label">Who We Are Sub-Title</label>
                                            <textarea name="about_subtitle" class="form-control" rows="10" id="about_subtitle" placeholder="Write About Us in Bangla">{{ old('about_subtitle') ?: $websiteParameter->about_subtitle ?? '' }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="about_us_image" class="control-label">Upload Image</label>
                                            <input type="file" name="about_us_image" class="form-control" id="about_us_image" onchange="previewAboutUsImage(event)">
                                        </div>
                                    </div>

                                     <!-- Image Preview -->
                                    <div class="col-sm-4">
                                        <div class="w3-display-container" style="height:110px; width:100%; border:1px solid #ddd; border-radius:5px; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                                            @if($websiteParameter->about_img)
                                                <img 
                                                    class="img-responsive about-preview" 
                                                    src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $websiteParameter->about_img()]) }}" 
                                                    alt="Preview Image" 
                                                    id="showAboutUsImage"
                                                >
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center" style="height:110px; width:100%;">
                                                    <span class="text-muted">No Image</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- about section end  -->


               {{-- <div class="row">
                    <div class="card">
                        <div class="card-header">
                             Services Images 
                        </div>
                         <div class="card-body w3-light-gray">
                            <div class="row">
                            <div class="col-sm-6">
                                <div class="card card-widget">
                                        <div class="card-header with-border">
                                            <h3 class="card-title">Pharmacy Eccomerce Image
                                                 <span class="text-danger">&nbsp;&nbsp;Better Size: (276x184px)</span>
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-group ">
                                                        <label for="eccomerce_img" class="col-sm-3 control-label">Image</label>
                                                        <div class="col-sm-9">
                                                            <input type="file" name="eccomerce_img" class="" id="eccomerce_img">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="w3-display-container" style="height:110px;">
                                                    <img class="img-responsive" style="width: 50px;" src="{{ route('imagecache', ['template' => 'original', 'filename' => $websiteParameter->eccomerce_img()]) }}" alt="" id="showFavicon">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-widget">
                                    <div class="card-header with-border">
                                        <h3 class="card-title">Hospital Service Image
                                             <span class="text-danger">&nbsp;&nbsp;Better Size: (276x184px)</span>
                                        </h3>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group ">
                                                    <label for="hospital_img" class="col-sm-3 control-label">Image
                                                        
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="hospital_img" class="" id="hospital_img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="w3-display-container" style="max-height:110px;">
                                                    <img class="img-responsive" style="max-width: 100%;" src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $websiteParameter->hospital_img()]) }}" alt="" id="showLogo">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="card card-widget">
                                    <div class="card-header with-border">
                                        <h3 class="card-title">Ambulance Service Image
                                              <span class="text-danger">&nbsp;&nbsp;Better Size: (276x184px)</span>
                                        </h3>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group ">
                                                    <label for="ambulance_img" class="col-sm-4 control-label">Image</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" name="ambulance_img" class="" id="ambulance_img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="w3-display-container" style="height:110px;">
                                                    <img class="img-responsive" style="max-width: 100%;" src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $websiteParameter->ambulance_img()]) }}" alt="" id="showLogoAlt">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <div class="card card-widget">
                                    <div class="card-header with-border">
                                        <h3 class="card-title">Doctor Service Image
                                              <span class="text-danger">&nbsp;&nbsp;Better Size: (276x184px)</span>
                                        </h3>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group ">
                                                    <label for="doctor_img" class="col-sm-4 control-label">Image</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" name="doctor_img" class="" id="doctor_img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="w3-display-container" style="height:110px;">
                                                    <img class="img-responsive" style="max-width: 100%;" src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $websiteParameter->doctor_img()]) }}" alt="" id="showLogoAlt">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>


                             <div class="col-sm-6">
                                <div class="card card-widget">
                                    <div class="card-header with-border">
                                        <h3 class="card-title">Diagnostic Service Image
                                              <span class="text-danger">&nbsp;&nbsp;Better Size: (276x184px)</span>
                                        </h3>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group ">
                                                    <label for="diagnostic_img" class="col-sm-4 control-label">Image</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" name="diagnostic_img" class="" id="diagnostic_img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="w3-display-container" style="height:110px;">
                                                    <img class="img-responsive" style="max-width: 100%;" src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $websiteParameter->diagnostic_img()]) }}" alt="" id="showLogoAlt">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            </div>
                        </div>
                    </div>
                   
                </div>--}}

                
                

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary pull-right">Update</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.3.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#about_us_en')).catch(error => console.error(error));
    ClassicEditor.create(document.querySelector('#about_us_bn')).catch(error => console.error(error));
</script>
<script>
        // Image previews remain same
    $('#logo').change(function(e){
        var reader = new FileReader();
        reader.onload=function(e){
            $('#showLogo').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });

    $('#favicon').change(function(e){
        var reader = new FileReader();
        reader.onload=function(e){
            $('#showFavicon').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });

    $('#logo_alt').change(function(e){
        var reader = new FileReader();
        reader.onload=function(e){
            $('#showLogoAlt').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });

    $('#about_us_image').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#showAboutUsImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
</script>
@endsection

@section('js')
<script>
    // // Initialize CKEditor for both English and Bangla textareas
    // CKEDITOR.replace('about_us_en', {
    //     height: 300,
    //     removeButtons: 'PasteFromWord'
    // });
    // CKEDITOR.replace('about_us_bn', {
    //     height: 300,
    //     contentsLanguage: 'bn'
    // });


</script>



@endsection
