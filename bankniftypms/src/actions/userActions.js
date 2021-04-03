import * as types from "./actionsTypes"
import submittingRequestStatus from "./submittingRequestStatusAction"
import * as API from "../utils/apiPath"
import { agent } from "../utils/agent"
import { setToaster } from "../utils/helpers"

export function ParamsDataSuccess(userParams) {
  return { type: types.LOADED_USER_PARAM_SUCCESS, userParams }
}

export function loginDataSuccess(userInfo) {
  return { type: types.LOADED_USER_INFO_SUCCESS, userInfo }
}

export function loadUserAuth(isAuth) {
  return { type: types.LOADED_USER_AUTH_SUCCESS, isAuth }
}

export function userLoginData(params) {
  return async function (dispatch) {
    dispatch(submittingRequestStatus(true))
    await agent
      .post(API.LOGIN, params)
      .then((response) => {
        setToaster(response.data.message, "#49BE00")
        dispatch(submittingRequestStatus(false))
        dispatch(loginDataSuccess(response.data.data))
        dispatch(loadUserAuth(true))
        localStorage.setItem("userToken", response.data.data.api_token)
        if (params.remember_me) {
          console.log("anil")
          dispatch(ParamsDataSuccess(params))
        } else {
          dispatch(ParamsDataSuccess({}))
        }
      })
      .catch((error) => {
        setToaster(error.message)
        dispatch(submittingRequestStatus(false))
      })
  }
}
