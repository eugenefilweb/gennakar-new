// import FilerobotImageEditor from 'filerobot-image-editor'; // Load library from NPM
// or load from CDN as following and use (window.FilerobotImageEditor):
// <script src="https://scaleflex.cloudimg.io/v7/plugins/filerobot-image-editor/latest/filerobot-image-editor.min.js"></script>

const { TABS, TOOLS } = FilerobotImageEditor;
const config = {
    source: document.getElementById('editor_container').dataset.src,
    theme: {
        palette: {
            'bg-primary-active': '#red',
        },
        typography: {
            fontFamily: 'Roboto, Arial',
        },
    },
    onSave: (editedImageObject, designState) => {
        const a = document.createElement("a");
        a.href = editedImageObject.imageBase64;
        a.download = editedImageObject.fullName;
        a.click();


        fetch(editedImageObject.imageBase64)
        .then(res => res.blob())
        .then(blob => {
            const path = [
                'protected',
                'uploads',
                'Edits',
            ];
            KTApp.block('#editor_container', {
                overlayColor: '#000000',
                state: 'primary',
                message: 'Uploading...'
            })
            const formData = new FormData();
            formData.append('UploadForm[fileInput]', blob, editedImageObject.fullName);
            formData.append('UploadForm[modelName]', 'Edits');
            formData.append('UploadForm[path]', path.join(','));

            $.ajax({
                url: app.baseUrl + 'file/upload',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(s) {
                    Swal.fire({
                        title: "Success",
                        text: 'The file was uploaded to Document Library (Edits)',
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonText: "Document Library (Edits)",
                        cancelButtonText: "Close",
                    }).then(function(result) {
                        if (result.value) {
                            window.location.href = app.baseUrl + 'dashboard/document-library?path=Edits';
                        }
                        else if (result.dismiss === "cancel") {
                        }
                    });
                    KTApp.unblock('#editor_container');
                },
                error:function(e) {
                    KTApp.unblock('#editor_container');
                },
            });
        })
    },
    Text: { text: 'Enter Text Here' },
    Rotate: { angle: 90, componentType: 'slider' },
    translations: {
        profile: 'Profile',
        coverPhoto: 'Cover photo',
        facebook: 'Facebook',
        socialMedia: 'Social Media',
        fbProfileSize: '180x180px',
        fbCoverPhotoSize: '820x312px',
    },
    Crop: {
        presetsItems: [
            {
                titleKey: 'classicTv',
                descriptionKey: '4:3',
                ratio: 4 / 3,
                // icon: CropClassicTv, // optional, CropClassicTv is a React Function component. Possible (React Function component, string or HTML Element)
            },
            {
                titleKey: 'cinemascope',
                descriptionKey: '21:9',
                ratio: 21 / 9,
                // icon: CropCinemaScope, // optional, CropCinemaScope is a React Function component.  Possible (React Function component, string or HTML Element)
            },
        ],
        presetsFolders: [
            {
                titleKey: 'socialMedia', // will be translated into Social Media as backend contains this translation key
                // icon: Social, // optional, Social is a React Function component. Possible (React Function component, string or HTML Element)
                groups: [
                    {
                        titleKey: 'facebook',
                        items: [
                            {
                                titleKey: 'profile',
                                width: 180,
                                height: 180,
                                descriptionKey: 'fbProfileSize',
                            },
                            {
                                titleKey: 'coverPhoto',
                                width: 820,
                                height: 312,
                                descriptionKey: 'fbCoverPhotoSize',
                            },
                        ],
                    },
                ],
            },
        ],
    },
    tabsIds: [], // or [TABS.ADJUST, TABS.ANNOTATE, TABS.WATERMARK]
    defaultTabId: TABS.ANNOTATE, // or 'Annotate'
    defaultToolId: TOOLS.PEN, // or 'Text'
    // showBackButton: true,
    annotationsCommon: {
        fill: '#F64E60',
        stroke: '#F64E60',
        strokeWidth: 0,
        shadowOffsetX: 0,
        shadowOffsetY: 0,
        shadowBlur: 0,
        shadowColor: '#F64E60',
        shadowOpacity: 1,
        opacity: 1,
    },
    Pen: {
        strokeWidth: 3,
        tension: 0.5,
        lineCap: 'round',
    },
    Line: {
        lineCap: 'butt',
        strokeWidth: 3,
    },
    // showCanvasOnly: true,
};

// Assuming we have a div with id="editor_container"
const filerobotImageEditor = new FilerobotImageEditor(
    document.querySelector('#editor_container'),
    config,
);

filerobotImageEditor.render({
    onClose: (closingReason) => {
        filerobotImageEditor.terminate();
    },
});