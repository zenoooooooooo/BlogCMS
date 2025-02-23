class InputManager {
  constructor(type, inputId, containerId, hiddenInputId) {
    this.type = type;
    this.inputField = document.getElementById(inputId);
    this.container = document.getElementById(containerId);
    this.hiddenInput = document.getElementById(hiddenInputId);
    this.items = [];

    this.addItem = this.addItem.bind(this);
    this.removeItem = this.removeItem.bind(this);
    this.updateUI = this.updateUI.bind(this);
    this.prepareFormData = this.prepareFormData.bind(this);
  }

  addItem() {
    let itemValue = this.inputField.value.trim();
    if (itemValue && !this.items.includes(itemValue)) {
      this.items.push(itemValue);
      this.updateUI();
    }
    this.inputField.value = "";
  }

  updateUI() {
    this.container.innerHTML = "";

    if (this.items.length === 0) {
      this.container.style.display = "none";
    } else {
      this.container.style.display = "flex";
    }

    this.items.forEach((item, index) => {
      let itemElement = document.createElement("div");
      itemElement.classList.add(this.type);
      itemElement.innerHTML = `${item} <span style="cursor: pointer;" onclick="${this.type}Manager.removeItem(${index})">×</span>`;
      this.container.appendChild(itemElement);
      alert(this.items.length);
    });

    this.hiddenInput.value = this.items.join(",");
  }

  removeItem(index) {
    this.items.splice(index, 1);
    this.updateUI();
  }

  prepareFormData() {
    this.hiddenInput.value = this.items.join(",");
  }
}

document.addEventListener("DOMContentLoaded", function () {
  window.categoryManager = new InputManager(
    "category",
    "categoryInput",
    "categoryContainer",
    "hiddenCategories"
  );
  window.tagManager = new InputManager(
    "tag",
    "tagInput",
    "tagContainer",
    "hiddenTags"
  );
});
