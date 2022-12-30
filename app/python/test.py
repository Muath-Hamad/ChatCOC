import sys
import json


#x=sys.argv[1] # this is a system variable where a JSON will be passed from Laravel
# y has sample JSON code that is tested and carries out to laravel if called from there
y='''
{
"TestArray":[
    {
    "arg1": "test arg1",
    "arg2": "test arg2"
    },
    {
    "arg1": "test arg1",
    "arg2": "test arg2"
    }
]
}
'''
data=json.loads(y) # loads method will take in a JSON code and decode it to be loaded in data python variable ..
                    # data can be many types of variables depending on the passed JSON

print(json.dumps(data))

