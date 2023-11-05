// const client = filestack.init(process.env.FS_API_KEY);
const client = filestack.init('AwxQNt5QZCr9LcJtnxGBQz');
// client.picker().open();

const image = document.getElementById('imageElement');
const fileInput = document.getElementById('fileInput');

fileInput.addEventListener("change", (e) => {
    const file = e.target.files[0];

    client.upload(file).then((response) => {
        image.src = response.url;
    }).catch((error) => [
        console.log(error)
    ]);
});

// const apikey = 'AwxQNt5QZCr9LcJtnxGBQz';
// const client = filestack.init(apikey); 

// var options ={
// 	"accept": [
// 		"image/*"
// 	],
// 	"fromSources": [
// 		"local_file_system",
// 		"url",
// 		"local_file_system"
// 	],
// 	"maxSize": 10
// };

// const picker = client.picker(options); 
// picker.open();