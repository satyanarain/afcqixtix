<div>
    {{   dispalyImage('images/photo/', $value->image_path, "profile-user-img img-responsive img-circle", "User profile picture",'cursor:pointer;margin: 0 auto;width: 100%; height: 100%;') }}
</div>
<input type="file" id="user_profile_image_input" style="display: none;">
<div id="image_upload_error_message" style="display: none;"></div>