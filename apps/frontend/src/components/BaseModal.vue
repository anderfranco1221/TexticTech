<template>
  <Teleport to="body">
    <transition name="modal-fade">
      <div v-if="modelValue"
        class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent"
        @click.self="closeModal">
        <!-- Overlay -->
        <div
          class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in">
        </div>

        <div tabindex="0"
          class="flex lg:min-h-full md:min-h-2/2 items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
          <div id="modalContent"
            class="relative transform overflow-hidden rounded-lg bg-background-secondary text-foreground text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full data-closed:sm:translate-y-0 data-closed:sm:scale-95"
            :class="withClass">
            <header class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4" v-if="hasHeaderSlot || title">
              <!-- Header Slot -->
              <slot name="header">
                <h3 id="dialog-title" class="text-lg font-medium leading-6">{{ title }}</h3>
              </slot>
              <!-- Close Button -->
              <button v-if="showCloseButton" type="button" class="text-lg font-medium leading-6 absolute right-6 top-4 cursor-pointer"
                @click="closeModal">
                &times;
              </button>
            </header>
            <!-- <div class="h-0.5 mx-auto bg-gray-400 dark:bg-gray-700"></div> -->

            <!-- Modal Content -->
            <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="sm:items-start">
                <slot></slot>
              </div>
            </div>
            <footer v-if="hasFooterSlot || showDefaultFooter"
              class="px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
              <slot name="footer">
                <div class="grid md:grid-cols-2 sm:grid-cols-1">
                  <button type="button" command="close" commandfor="dialog"
                  class="mt-3! m-1! inline-flex w-full justify-center rounded-md bg-secondary px-3 py-2 text-sm font-semibold text-foreground shadow-xs ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto cursor-pointer"
                  @click="confirmModal">Guardar</button>

                  <button type="button" command="close" commandfor="dialog"
                  class="mt-3! m-1! inline-flex w-full justify-center rounded-md bg-muted border-2 border-solid px-3 py-2 text-sm font-semibold text-foreground shadow-xs  ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto cursor-pointer"
                  @click="closeModal">Cancelar</button>

                </div>
              </slot>
            </footer>
          </div>
        </div>
      </div>
    </transition>
  </Teleport>
</template>

<script lang="ts">
import { defineComponent, computed } from 'vue';

export default defineComponent({
  name: 'BaseModal',
  props: {
    // Controla la visibilidad del modal (usado con v-model)
    modelValue: {
      type: Boolean,
      required: true,
    },
    // Título opcional del modal
    title: {
      type: String,
      default: '',
    },
    // Ancho máximo del modal (ej. '500px', '80%')
    withClass: {
      type: String,
      default: 'sm:max-w-lg',
    },
    // Mostrar u ocultar el botón de cerrar 'x' en el encabezado
    showCloseButton: {
      type: Boolean,
      default: true,
    },
    // Mostrar u ocultar el pie de página por defecto (botones Cancelar/Aceptar)
    showDefaultFooter: {
      type: Boolean,
      default: true,
    },
    // Permite cerrar el modal haciendo clic fuera de él
    closeOnClickOutside: {
      type: Boolean,
      default: true,
    },
  },
  emits: [
    'update:modelValue', // Para el funcionamiento de v-model
    'confirm',           // Emitido cuando se presiona el botón "Aceptar" del footer por defecto
    'close'              // Emitido cuando el modal se cierra por cualquier medio (botón, click fuera)
  ],
  setup(props, { emit, slots }) {
    // Verifica si hay contenido en el slot 'header'
    const hasHeaderSlot = computed(() => !!slots.header);
    // Verifica si hay contenido en el slot 'footer'
    const hasFooterSlot = computed(() => !!slots.footer);

    // Método para cerrar el modal
    const closeModal = () => {
      if (props.closeOnClickOutside) {
        emit('update:modelValue', false); // Actualiza la prop modelValue a false
        emit('close'); // Emite un evento 'close'
      }
    };

    // Método para confirmar el modal (llamado por el botón "Aceptar" por defecto)
    const confirmModal = () => {
      emit('confirm'); // Emite un evento 'confirm'
      emit('update:modelValue', false); // Cierra el modal después de confirmar
      emit('close'); // Emite un evento 'close'
    };

    return {
      hasHeaderSlot,
      hasFooterSlot,
      closeModal,
      confirmModal,
    };
  },
});
</script>
