# 打开原文件和新文件
with open('1.list', 'r', encoding='utf-8') as input_file:
    # 读取所有行，筛选包含'baidu'的行，并替换DOMAIN-SUFFIX为domain
    baidu_lines = [line.strip().replace('DOMAIN-SUFFIX', 'domain') 
                  for line in input_file 
                  if 'baidu' in line.lower()]

# 将处理后的内容写入原文件
with open('2.list', 'w', encoding='utf-8') as output_file:
    # 写入处理后的行
    output_file.write('\n'.join(baidu_lines))

# 打印处理结果
print(f'处理完成，保留了{len(baidu_lines)}行包含baidu的内容')
print('所有的DOMAIN-SUFFIX已替换为domain')

# 打印前几行示例
print('\n处理后的前5行示例：')
for line in baidu_lines[:5]:
    print(line)