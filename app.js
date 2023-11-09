// Initializing Filestack with API key
const client = filestack.init('AwxQNt5QZCr9LcJtnxGBQz');
const imageInput = document.getElementById('upload-button');
const imageUrlInput = document.getElementById('image-url');

// Attaching an image upload event
imageInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    // Image uploading via Filestack
    client.upload(file).then((response) => {
        const imageUrl = response.url;
        console.log("URL: " + imageUrl);
        
        // Save url into hidden input
        imageUrlInput.value = imageUrl;
        console.log("URL: " + imageUrlInput.value);
    }).catch((error) => {
        console.log(error);
    });
});
// const client = filestack.init('AwxQNt5QZCr9LcJtnxGBQz');
// const imageInput = document.getElementById('upload-button');

// if (imageInput) {
//     // Attaching an image upload event
//     imageInput.addEventListener('change', () => {
//         // Image uploading via Filestack
//         client.picker({
//             accept: 'image/*',
//             onUploadDone: (file) => {
//                 // Get URL of uploaded image
//                 const imageUrl = file.url;
    
//                 // Set URL as "image_url" field value
//                 document.getElementById('image-url').value = imageUrl;
//                 console.log('URL завантаженого зображення:', imageUrl);
//             }
//         }).open();
//     });
// } else {
//     console.log('Error');
// }

// const client = filestack.init('AwxQNt5QZCr9LcJtnxGBQz');

// // const image = document.getElementById('imageElement');
// const fileInput = document.getElementById('filestack-picker');

// fileInput.addEventListener("click", (e) => {
//     const file = e.target.files[0];

//     client.upload(file).then((response) => {
//         console.log("URL завантаженого файлу:", response.url);
//         // image.src = response.url;
//     }).catch((error) => {
//         console.log(error);
//     });
// });