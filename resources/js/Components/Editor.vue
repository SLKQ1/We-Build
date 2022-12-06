<template>
    <form>
        <div class="w-full border rounded-lg bg-gray-700 border-gray-600">
            <div class="flex items-center justify-between px-3 py-2 border-b border-gray-600">
                <div class="flex flex-wrap items-center sm:divide-x divide-gray-600">
                    <div class="flex items-center space-x-1 sm:pr-4">
                        <button @click="editor.chain().focus().undo().run()" type="button"
                            class="p-2 text-gray-400 rounded cursor-pointer hover:text-white">
                            <font-awesome-icon icon="fa-solid fa-rotate-left" />
                        </button>
                        <button @click="editor.chain().focus().redo().run()" type="button"
                            class="p-2 text-gray-400 rounded cursor-pointer hover:text-white">
                            <font-awesome-icon icon="fa-solid fa-rotate-right" />
                        </button>
                    </div>
                    <div class="flex flex-wrap items-center space-x-1 sm:pl-4">
                        <!-- TODO: Get link working -->
                        <!-- <button @click="editor.chain().focus()" type="button"
                            class="p-2 text-gray-400 rounded cursor-pointer    hover:text-white ">
                            <font-awesome-icon icon="fa-solid fa-link" />
                        </button> -->
                        <button @click="editor.chain().focus().toggleUnderline().run()" type="button"
                            class="p-2 text-gray-400 rounded cursor-pointer hover:text-white">
                            <font-awesome-icon icon="fa-solid fa-underline" />
                        </button>
                        <button @click="editor.chain().focus().toggleBold().run()" type="button"
                            class="p-2 text-gray-400 rounded cursor-pointer hover:text-white">
                            <font-awesome-icon icon="fa-solid fa-bold" />
                        </button>
                        <button @click="editor.chain().focus().toggleItalic().run()" type="button"
                            class="p-2 text-gray-400 rounded cursor-pointer hover:text-white">
                            <font-awesome-icon icon="fa-solid fa-italic" />
                        </button>
                        <button @click="editor.chain().focus().toggleCodeBlock().run()" type="button"
                            class="p-2 text-gray-400 rounded cursor-pointer hover:text-white">
                            <font-awesome-icon icon="fa-solid fa-code" />
                        </button>

                        <button v-if="editor" @click="editor.chain().focus().toggleBulletList().run()" type="button"
                            class="p-2 text-gray-400 rounded cursor-pointerhover:text-white">
                            <font-awesome-icon icon="fa-solid fa-list-ul" />
                        </button>
                        <button @click="editor.chain().focus().toggleOrderedList().run()" type="button"
                            class="p-2 text-gray-400  rounded cursor-pointerhover:text-white">
                            <font-awesome-icon icon="fa-solid fa-list-ol" />
                        </button>
                        <!-- TODO: Get checklist working -->
                        <!-- <button @click="editor.chain().focus().toggleTaskList().run()" type="button"
                            class="p-2 text-gray-400 rounded cursor-pointer    hover:text-white ">
                            <font-awesome-icon icon="fa-solid fa-list-check" />
                        </button> -->
                        <button @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" type="button"
                            class="p-2 text-gray-400 rounded cursor-pointer hover:text-white">
                            H1
                        </button>
                        <button @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" type="button"
                            class="p-2 text-gray-400 rounded cursor-pointer hover:text-white">
                            H2
                        </button>
                        <button @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" type="button"
                            class="p-2 text-gray-400 rounded cursor-pointer hover:text-white">
                            H3
                        </button>
                        <button @click="editor.getchain().focus().setParagraph().run()" type="button"
                            class="p-2 text-gray-400 rounded cursor-pointer hover:text-white">
                            <font-awesome-icon icon="fa-solid fa-paragraph" />
                        </button>
                    </div>
                </div>
            </div>
            <div class="px-4 py-2 bg-white rounded-b-lg">
                <editor-content :editor="editor" />
            </div>
        </div>
    </form>
</template>

<script>
import { Editor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import Underline from '@tiptap/extension-underline'
import TaskItem from '@tiptap/extension-task-item'
import TaskList from '@tiptap/extension-task-list'
import Link from '@tiptap/extension-link'

export default {
    components: {
        EditorContent,
    },

    data() {
        return {
            editor: null,
        }
    },

    mounted() {
        this.editor = new Editor({
            editorProps: {
                attributes: {
                    class: 'prose prose-sm sm:prose lg:prose-lg xl:prose-2xl m-5 focus:outline-none text-sm min-h-[50vh]',
                },
            },
            content: '<p>Enter your project description here!</p>',
            extensions: [
                StarterKit.configure({
                    heading: {
                        HTMLAttributes: {
                            levels: [1, 2, 3],
                        }
                    }
                }),
                Underline,
                TaskList,
                TaskItem.configure({
                    //   nested: true,
                }),
                Link.configure({
                    openOnClick: false,
                    autolink: true,
                }),
            ],
        })
    },

    beforeUnmount() {
        this.editor.destroy()
    },

    methods: {
        getEditorContentAsJson() {
            console.log(this.editor.getHTML())
            return this.editor.getHTML()
        }
    }
}
</script>