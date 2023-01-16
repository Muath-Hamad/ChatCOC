#!/usr/bin/env python
# coding: utf-8
import os
import sys
os.path.dirname(sys.executable)

# to transfer arabic number to english
import pyarabic.trans

import pandas as pd
import numpy as np
import tabula

# convert PDF into CSV file
tabula.convert_into("../data/StudentGPA.pdf", "../data/StudentGPA.csv", output_format="csv", pages='all')

df = pd.read_csv('../data/StudentGPA.csv',  on_bad_lines='skip')

df = df[df['رمز المقرر'] !='رمز المقرر' ]

df["الساعات"] = df["الساعات"].astype(int)

# # thus it give me that i only have 118 hours

df["الساعات"].sum()

for ind , row in df.iterrows() :
    for i in df.columns :
        try:
            df[i][ind] = pyarabic.trans.normalize_digits(row[i])
        except:
            pass

df.to_csv('../data/StudentGPA.csv' , index=False)
