import React, { useEffect, Suspense, useState } from "react"
import { getSettingData } from "../actions/settingActions"
import { useSelector, useDispatch } from "react-redux"
import ScrollToTop from "../Component/ScrollToTop"
import Loading from "../Component/Loader"
import Page from "../Pages"
import "./../assets/css/style.css"
import "./../assets/css/media.css"
import "./../assets/css/dashboard.css"
import "bootstrap/dist/css/bootstrap.min.css"
import "@fortawesome/fontawesome-free/css/all.css"

const App = () => {
  const dispatch = useDispatch()
  const [visible, setVisible] = useState(false)
  const { isAuth, isFetching } = useSelector((state) => ({
    isAuth: state.isAuth,
    isFetching: state.isFetching,
  }))
  const toggleVisible = () => {
    const scrolled = document.documentElement.scrollTop
    if (scrolled > 300) {
      setVisible(true)
    } else if (scrolled <= 300) {
      setVisible(false)
    }
  }
  window.addEventListener("scroll", toggleVisible)

  useEffect(() => {
    const fetchData = () => {
      dispatch(getSettingData())
    }
    fetchData()
  }, [dispatch])

  const scrollToTop = () => {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    })
  }
  return (
    <>
      <Suspense fallback={<Loading />}>
        {isFetching && <Loading />}
        <ScrollToTop />
        <Page isAuth={isAuth} />
      </Suspense>
      {visible && (
        <span className="pull_top mb-5" onClick={scrollToTop}>
          <i className="fa fa-arrow-up" aria-hidden="true"></i>
        </span>
      )}
    </>
  )
}

export default App
