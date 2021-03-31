import * as types from "./actionsTypes"
import { agent } from "../utils/agent"
import * as API from "../utils/apiPath"
import { setToaster } from "../utils/helpers"

export function loadHomePageDataSuccess(homePageData) {
  return { type: types.LOAD_HOME_PAGE_DATA_SUCCESS, homePageData }
}

export function loadHomePageData(id) {
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
