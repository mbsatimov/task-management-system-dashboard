import "./bootstrap"
import "../css/app.css"

import { createApp, h } from "vue"
import { createInertiaApp, Head, Link } from "@inertiajs/vue3"
import { ZiggyVue } from "../../vendor/tightenco/ziggy"
import Layout from "@/layouts/Layout.vue"

createInertiaApp({
  title: title => `Task Management - ${title}`,
  resolve: name => {
    const pages = import.meta.glob("./pages/**/*.vue", { eager: true })
    const page = pages[`./pages/${name}.vue`]
    page.default.layout = page.default.layout || Layout
    return page
  },
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .component("Head", Head)
      .component("Link", Link)
      .mount(el)
  },
  progress: {
    color: "#546FFF",
    includeCSS: true,
    showSpinner: true,
  },
})
