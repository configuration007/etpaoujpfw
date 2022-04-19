<template>
  <div class="dropzone">
    <div class="layer layer_1">
      <input type="file" class="input_field" @change="uploadImage" />
    </div>
    <div class="layer layer_2" v-if="!uploaded">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="icon icon-tabler icon-tabler-arrow-up-circle"
        width="56"
        height="56"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="#ccc"
        fill="none"
        stroke-linecap="round"
        stroke-linejoin="round"
      >
        <path stroke="none" d="M0 0h24v24H0z" />
        <circle cx="12" cy="12" r="9" />
        <line x1="12" y1="8" x2="8" y2="12" />
        <line x1="12" y1="8" x2="12" y2="16" />
        <line x1="16" y1="12" x2="12" y2="8" />
      </svg>
      {{caption}}
    </div>
    <div class="cancel_photo" v-if="uploaded" @click="resetPhoto">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="icon icon-tabler icon-tabler-x"
        width="44"
        height="44"
        viewBox="0 0 24 24"
        stroke-width="1"
        stroke="red"
        fill="red"
        stroke-linecap="round"
        stroke-linejoin="round"
      >
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <line x1="18" y1="6" x2="6" y2="18" />
        <line x1="6" y1="6" x2="18" y2="18" />
      </svg>
    </div>
    <div class="layer layer_3" v-if="uploaded">
      <img v-bind:src="photo_data" alt="error" />
    </div>
  </div>
</template>
<script>
//importing event bus needed to transfer image detail to parent component
export default {
  props: ["imagevalue","caption"],
  data() {
    return {
      uploaded: false,
      photo_data: "/image/default.png",
    };
  },
  watch: {
    imagevalue: function (val) {
      this.changedImage();
    },
  },
  methods: {
    changedImage() {
      if (this.imagevalue != null && this.imagevalue != "") {
        this.photo_data = this.imagevalue;
        this.uploaded = true;
      }else{
              this.photo_data ="/image/default.png" ;
        this.uploaded = false;
      }
    },
    resetPhoto() {
      //reset image field
      this.uploaded = false;
      this.photo_data = "";
      this.$emit("clearImage");
    },
    imageCheck(file) {
      var Size = file["size"];
      var Filename = file["name"];
      var Extension = Filename.split(".").pop();
      //validate image size and type
      if (
        Extension == "gif" ||
        Extension == "png" ||
        Extension == "bmp" ||
        Extension == "jpeg" ||
        Extension == "jpg"
      ) {
        if (Size < 1048576) {
          return true;
        } else {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Image Size Above 1MB!",
          });
          return false;
        }
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Invalid Image Type",
        });
        return false;
      }
    },
    uploadImage(element) {
      //coverstion of photo to base 64, for easier transfer
      let file = element.target.files[0];
      var reader = new FileReader();
      if (this.imageCheck(file)) {
        reader.onloadend = (file) => {
          this.photo_data = reader.result;
          this.uploaded = true;
          this.$emit("imageUpdated", this.photo_data);
          //photo data is emitted to parent component on change
        };
      }
      reader.readAsDataURL(file);
    },
    editModePhoto(imagename) {
      this.photo_data = imagename;
      this.uploaded = true;
      //setting a preview of old image
    },
  },
  created() {},
  mounted() {
    this.changedImage();
  },
};
</script>
<style scoped>
.dropzone {
  height: 100%;
  padding: 10px;
  position: relative;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  outline: 2px dashed grey;
  outline-offset: -10px;
  /* background:rgb(228, 228, 240); */
  color: #ccc;
  overflow: hidden;
}
.layer {
  position: absolute;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 90%;
  height: 90%;
}
.layer_3,
.layer_2 {
  z-index: 1;
}
.layer_3 {
  padding: 5px;
}
.layer_3 img {
  width: 100%;
  height: auto;
  margin: auto;
}
.cancel_photo {
  position: absolute;
  width: 25px;
  height: 25px;
  display: flex;
  justify-content: center;
  top: 10px;
  align-items: center;
  /* border: 1px solid red; */
  right: 10px;
  z-index: 50;
}
.layer_1 {
  z-index: 5;
  background: none;
}
.input_field {
  opacity: 0;
  z-index: 1;
  width: 100%;
  height: 100%;
  /* border:1px solid green; */
  cursor: pointer;
  position: absolute;
}
.uploaded {
  opacity: 0;
  z-index: 20;
  width: 100%;
  height: 200px;
  cursor: pointer;
  position: absolute;
}
.dropzone:hover {
  background: rgb(244, 244, 248);
}
.call-to-action {
  font-size: 1.2rem;
}
</style>
