import sys
import json

x=sys.argv[1]
data=json.loads(x)

print(json.dumps(data))
