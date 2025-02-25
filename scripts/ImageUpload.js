class ImageUploader {
  constructor(
    fileInputId,
    textInputId,
    uploadButtonId,
    hiddenInputId,
    allowedTypes
  ) {
    this.fileInput = document.getElementById(fileInputId);
    this.textInput = document.getElementById(textInputId);
    this.uploadButton = document.getElementById(uploadButtonId);
    this.hiddenInput = document.getElementById(hiddenInputId);
    this.allowedTypes = allowedTypes;

    this.init();
  }

  init() {
    this.uploadButton.addEventListener("click", () => this.triggerFileInput());
    this.fileInput.addEventListener("change", (event) =>
      this.handleFileSelect(event)
    );
  }

  triggerFileInput() {
    this.fileInput.click();
  }

  handleFileSelect(event) {
    const file = event.target.files[0];
    if (!file) return;

    if (this.isValidFileType(file)) {
      this.textInput.placeholder = file.name;
      this.hiddenInput.value = file.name;
    } else {
      alert("Invalid file type! Please upload a JPG, JPEG, or PNG image.");
      this.fileInput.value = "";
      this.hiddenInput.value = "";
    }
  }

  isValidFileType(file) {
    return this.allowedTypes.includes(file.type);
  }

  prepareFormData() {
    if (this.fileInput.files.length > 0) {
      this.hiddenInput.value = this.fileInput.files[0].name;
    }
  }
}

document.addEventListener("DOMContentLoaded", function () {
  window.imageUploader = new ImageUploader(
    "fileInput",
    "imageTextInput",
    "uploadButton",
    "hiddenImageFilename",
    ["image/jpeg", "image/png"]
  );
});
