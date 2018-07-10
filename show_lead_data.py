
from facebookads.adobjects.lead import Lead
from facebookads.api import FacebookAdsApi


access_token = '431139364026381|LTqxCsMhDQdKv_fue9-2QYbJoYY'
app_secret = '5c7c7b2f72cefc4223670374af83fc58'
app_id = '431139364026381'
id = '105812142804707'
FacebookAdsApi.init(access_token=access_token)

fields = [
]
params = {
}

print Lead(id).get(
    fields=fields,
    params=params,
)
