// Initializing Filestack with API key
const client = filestack.init('AwxQNt5QZCr9LcJtnxGBQz');

// Attaching an image upload event
document.getElementById('upload-button').addEventListener('click', () => {
    // Image uploading via Filestack
    client.pick({
        accept: 'image/*',
        onUploadDone: (result) => {
            // Get URL of uploaded image
            const imageUrl = result.filesUploaded[0].url;

            // Set URL as "image_url" field value
            document.getElementById('image-url').value = imageUrl;
        }
    });
});