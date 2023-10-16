<div>
    <div x-data="{
        focused: {{ $parentComment ? 'true' : 'false' }},
        isEdit: {{ $commentModel ? 'true' : 'false' }},
        init() {
            if(this.isEdit || this.focused) {
                this.$refs.input.focus()
            }
            $wire.on('commentCreated', () => {
                this.focused = false;
            })
        }
    }" class="m-4 w-full">
        <div class="mb-2">
            <label>
            <textarea   x-ref="input"
                        @click="focused = true"
                        wire:model="comment"
                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        :rows="isEdit || focused ? '3' : '1'"
                        placeholder="Leave a comment"></textarea>
            </label>
        </div>
        <div class="flex" :class="isEdit || focused ? '' : 'hidden'">
            <button type="submit" wire:click="createComment"
                    class="block rounded-md bg-indigo-600 text-white px-3.5 py-2.5 text-center text-sm font-semibold shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mr-3">Submit</button>
            <button @click="focused = false; isEdit = false; $wire.emitUp('cancelEditing')" >Cancel</button>
        </div>
    </div>
</div>
