# Automation script for non-interactive deployment
Script setup.sh for use on cloud based deployments, put this in your startup on a VM.
It copies the application components into /user/local/cftdemo
This is written for Ubuntu and tested on 20.04 LTS in GCP

# Terraform examples
Example in terraform, create a template file data resource based on the script file, thsi is assuming the file is in the root of a module.
```
data "template_file" "startup-script" {
  template = file(format("%s/setup.sh", path.module))

  vars = {
    SOME_VAR = ""
  }
}
```

In an instance template (in GCP) you would reference the script 
```
resource "google_compute_instance_template" "tpl" {
...
  metadata_startup_script = data.template_file.group-startup-script.rendered
...
}
```

In an instance (in GCP) you would reference the script 
```
resource "google_compute_instance" "default {

...
  metadata = data.template_file.group-startup-script.rendered
...

}
```

For automation you also need to consider opening ports to the instance, public IP addressing and possibly a load balancer config. 