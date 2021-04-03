import * as types from "./actionsTypes"
import { agent } from "../utils/agent"
import * as API from "../utils/apiPath"
import { setToaster } from "../utils/helpers"
import submittingRequestStatus from "./submittingRequestStatusAction"

export function loadHomePageDataSuccess(homePageData) {
  return { type: types.LOAD_HOME_PAGE_DATA_SUCCESS, homePageData }
}

export function loadPageDataSuccess(pageData) {
  return { type: types.LOAD_PAGE_DATA_SUCCESS, pageData }
}

export function loadHomePageData() {
  return async function (dispatch) {
    await agent
      .get(API.HOME_PAGE)
      .then((response) => {
        dispatch(loadHomePageDataSuccess(response.data.data))
      })
      .catch((error) => {
        setToaster(error.message)
      })
  }
}

export function loadPageData(slug) {
  return async function (dispatch) {
    await agent
      .get(API.CMS_PAGE + slug)
      .then((response) => {
        dispatch(loadPageDataSuccess(response.data.data))
      })
      .catch((error) => {
        setToaster(error.message)
      })
  }
}

export function submitContactRequest(params) {
  return async function (dispatch) {
    dispatch(submittingRequestStatus(true))
    await agent
      .post(API.SUBMIT_CONTACT_REQUEST, params)
      .then((response) => {
        setToaster(response.data.message, "#49BE00")
        dispatch(submittingRequestStatus(false))
      })
      .catch((error) => {
        setToaster(error.message)
        dispatch(submittingRequestStatus(false))
      })
  }
}
