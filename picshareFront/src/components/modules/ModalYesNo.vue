<template>
  <div v-if="show" class="modal-shadow" @click.self="closeModal">
    <div class="modal">
      <div class="modal-close" @click="closeModal">&#10006;</div>
      <slot name="title">
        <h3 class="modal-title">Заголовок</h3>
      </slot>
      <slot name="body">
        <div class="modal-content">
          Дефолтный контент модального окна
        </div>
      </slot>
      <slot name="footer">
        <div class="modal-footer">
          <button class="modal-footer__button" @click="closeModal">
            Ок
          </button>
        </div>
      </slot>
    </div>
  </div>
</template>

<script>
export default {
  name: "ModalWindow",
  data: function () {
    return {
      show: false
    }
  },
  methods: {
    closeModal: function () {
      this.show = false
    }
  }
}
</script>

<script>
export default {
  name: "ModalYesNo",
  data: function () {
    return {
      show: false
    }
  },
  methods: {
    closeModal: function () {
      this.show = false
    }
  }
}
</script>

<style scoped>

</style>