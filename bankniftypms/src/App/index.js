import React, { useEffect, Suspense } from "react"
import { getSettingData } from "../actions/settingActions"
import { useSelector, useDispatch } from "react-redux"
import ScrollToTop from "../Component/ScrollToTop"
import Loading from "../Component/Loader"
import Page from "../Pages"
import "./../assets/css/style.css"
import "./../assets/css/media.css"
import "bootstrap/dist/css/bootstrap.min.css"
import "@fortawesome/fontawesome-free/css/all.css"

const App = () => {
  const dispatch = useDispatch()
  const { isAuth, isFetching } = useSelector((state) => ({
    isAuth: state.isAuth,
    isFetching: state.isFetching,
  }))

  useEffect(() => {
    const fetchData = () => {
      dispatch(getSettingData())
    }
    fetchData()
  }, [dispatch])
  return (
    <>
      <Suspense fallback={<Loading />}>
        {isFetching && <Loading />}
        <ScrollToTop />
        <Page isAuth={isAuth} />
      </Suspense>
    </>
  )
}

export default App
