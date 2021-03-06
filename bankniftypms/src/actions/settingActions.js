import * as types from "./actionsTypes"
import { agent } from "../utils/agent"
import * as API from "../utils/apiPath"
import { setToaster } from "../utils/helpers"
import toggleNetworkRequestStatus from "./toggleNetworkRequestStatus"

export function loadDataSuccess(setting) {
  return { type: types.LOADED_SETTING_INFO_SUCCESS, setting }
}

export const getSettingData = () => async (dispatch) => {
  try {
    dispatch(toggleNetworkRequestStatus(true))
    const response = await agent.get(API.SETTING)
    dispatch(toggleNetworkRequestStatus(false))
    dispatch(loadDataSuccess(response.data.data))
  } catch (error) {
    dispatch(toggleNetworkRequestStatus(false))
    setToaster(error.message)
  }
}
