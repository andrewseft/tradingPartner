// CMS Page Routes
import HomePage from "../Pages/Home"
import NotFoundPage from "../Pages/NotFound"

export const RoutesPage = [
  { path: "/", component: HomePage, title: "Home" },
  {
    path: "/what-we-offer",
    component: HomePage,
    title: "What We Offer",
  },
  { path: "/why-us", component: HomePage, title: "Why Us" },
  { path: "/features", component: HomePage, title: "Features" },
  { path: "/404", component: NotFoundPage, title: "404" },
]
